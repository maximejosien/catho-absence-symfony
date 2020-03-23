<?php

namespace App\Service;

use App\Constant\DateDaysName;
use App\Entity\Absence;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CalendarService implements CalendarServiceInterface
{
    /** @var TranslatorInterface */
    private $translator;

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @param TranslatorInterface $translator
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(TranslatorInterface $translator, EntityManagerInterface $entityManager)
    {
        $this->translator = $translator;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \DateTime $dateMonth
     * @param User $user
     *
     * @return array
     *
     * @throws \Exception
     */
    public function computeCalendarOnMonth(\DateTime $dateMonth, User $user): array
    {
        $firstDateCalendar = $this->getFirstDateCalendar($dateMonth);
        $nextMonth = $this->getNextMonth($dateMonth);

        $calendar = [];

        $dateCalendar = clone $firstDateCalendar;

        $id = 0;

        for ($week = 0; !$this->isLastDateInCalendar($dateCalendar, $nextMonth); $week++) {
            for ($day = 0; $day < 7; $day++) {
                $calendar[$week][$day] = [
                    'id' => $id,
                    'date' => [
                        'dateTime' => clone $dateCalendar,
                        'day' => $dateCalendar->format('d'),
                        'month' => $dateCalendar->format('m'),
                        'year' => $dateCalendar->format('Y'),
                    ],
                    'absences' => $this->getAbsencesFromUserAndDateWithArrayFormat($user, $dateCalendar),
                    'currentMonth' => $this->isTheSameMonth($dateMonth, $dateCalendar)
                ];
                $id++;
                $dateCalendar->add(new \DateInterval('P1D'));
            }
        }

        return $calendar;
    }

    /**
     * @param \DateTime $currentDate
     *
     * @return \DateTime
     *
     * @throws \Exception
     */
    private function getFirstDateCalendar(\DateTime $currentDate): \DateTime
    {
        $firstDateCalendar = clone $currentDate;

        while (DateDaysName::SUNDAY !== $firstDateCalendar->format('l')) {
            $firstDateCalendar->sub(new \DateInterval('P1D'));
        }

        return $firstDateCalendar;
    }

    /**
     * @param \DateTime $currentDate
     *
     * @return string
     *
     * @throws \Exception
     */
    private function getNextMonth(\DateTime $currentDate): string
    {
        return date_add(clone $currentDate, new \DateInterval('P1M'))->format('F');
    }

    /**
     * @param \DateTime $dateCalendar
     *
     * @return bool
     */
    private function isLastDateInCalendar(\DateTime $dateCalendar, string $nextMonth): bool
    {
        return $nextMonth === $dateCalendar->format('F') && DateDaysName::SUNDAY === $dateCalendar->format('l');
    }

    /**
     * @param \DateTime $date
     * @param \DateTime $compareDate
     */
    private function isTheSameMonth(\DateTime $date, \DateTime $compareDate)
    {
        return $date->format('F') === $compareDate->format('F');
    }

    /**
     * @param \DateTime $date
     *
     * @return string
     */
    public function getDateWithMonthAndYear(\DateTime $date): string
    {
        $month = [
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december'
        ];

        return $this->translator->trans($month[$date->format("m") - 1], [], 'date') . ' ' . $date->format('Y');
    }

    /**
     * @param User $user
     * @param \DateTime $date
     *
     * @return array
     */
    private function getAbsencesFromUserAndDateWithArrayFormat(User $user, \DateTime $date): array
    {
        $absenceRepository = $this->entityManager->getRepository(Absence::class);

        return $absenceRepository->getAbsenceByUserAndDate($user, $date);
    }
}

<?php

namespace App\Service;

use App\Constant\DateDaysName;
use Symfony\Contracts\Translation\TranslatorInterface;

class CalendarService implements CalendarServiceInterface
{
    /** @var TranslatorInterface */
    private $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param \DateTime $dateMonth
     *
     * @return array
     *
     * @throws \Exception
     */
    public function computeCalendarOnMonth(\DateTime $dateMonth): array
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
                    'date' => clone $dateCalendar,
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

        return $this->translator->trans($month[$date->format("m") - 1], [], 'months') . ' ' . $date->format('Y');
    }
}

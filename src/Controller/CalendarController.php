<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Entity\User;
use App\Form\AbsenceFormType;
use App\Service\AbsenceHistoricalInterface;
use App\Service\AbsenceHistoricalServiceInterface;
use App\Service\CalendarServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CalendarController extends AbstractController
{
    /** @var CalendarServiceInterface */
    private $calendarService;

    /** @var AbsenceHistoricalServiceInterface */
    private $absenceHistoricalService;

    /**
     * @param CalendarServiceInterface $calendarService
     * @param AbsenceHistoricalServiceInterface $absenceHistoricalService
     */
    public function __construct(
        CalendarServiceInterface $calendarService,
        AbsenceHistoricalServiceInterface $absenceHistoricalService
    ) {
        $this->calendarService = $calendarService;
        $this->absenceHistoricalService = $absenceHistoricalService;
    }

    /**
     * @Route("/calendar/{dateFormat}", name="app_calendar")
     *
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param string $dateFormat
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function calendar(Security $security, EntityManagerInterface $entityManager, Request $request, string $dateFormat)
    {
        $dateMonth = new \DateTime($dateFormat);

        $absence = new Absence();

        $form = $this->createForm(AbsenceFormType::class, $absence);
        $form->handleRequest($request);

        $user = $security->getUser();

        if ($user instanceof User) {
            $absence->setUser($user);
        }

        $calendarOnMonth = $this->calendarService->computeCalendarOnMonth($dateMonth, $user);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($absence);
            $entityManager->flush();

            return $this->redirectToRoute('app_calendar', [
                'dateFormat' => $dateFormat,
            ]);
        }

        return $this->render('calendar/calendar.html.twig', [
            'calendarOnMonth' => $calendarOnMonth,
            'dateWithMonthAndYear' => $this->calendarService->getDateWithMonthAndYear($dateMonth),
            'monthBefore' => (clone $dateMonth)->sub(new \DateInterval('P1M'))->format('F-Y'),
            'monthAfter' => (clone $dateMonth)->add(new \DateInterval('P1M'))->format('F-Y'),
            'formAbsence' => $form->createView(),
            'absencesHistorical' => $this->absenceHistoricalService->getAbsenceHistoricalFromUser($user),
        ]);
    }
}

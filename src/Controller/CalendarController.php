<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Form\AbsenceFormType;
use App\Service\CalendarServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /** @var CalendarServiceInterface */
    private $calendarService;

    /**
     * @param CalendarServiceInterface $calendarService
     */
    public function __construct(CalendarServiceInterface $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    /**
     * @Route("/calendar/{dateFormat}", name="app_calendar")
     *
     * @param string $dateFormat
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function calendar(string $dateFormat)
    {
        $dateMonth = new \DateTime($dateFormat);

        $calendarOnMonth = $this->calendarService->computeCalendarOnMonth($dateMonth);

        $absence = new Absence();

        $form = $this->createForm(AbsenceFormType::class, $absence);

        return $this->render('calendar/calendar.html.twig', [
            'calendarOnMonth' => $calendarOnMonth,
            'dateWithMonthAndYear' => $this->calendarService->getDateWithMonthAndYear($dateMonth),
            'monthBefore' => (clone $dateMonth)->sub(new \DateInterval('P1M'))->format('F-Y'),
            'monthAfter' => (clone $dateMonth)->add(new \DateInterval('P1M'))->format('F-Y'),
            'formAbsence' => $form->createView()
        ]);
    }
}

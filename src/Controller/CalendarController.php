<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar")
     */
    public function calendar()
    {
        return $this->render('calendar/calendar.html.twig', [
            'datetime_now' => new \DateTime()
        ]);
    }
}

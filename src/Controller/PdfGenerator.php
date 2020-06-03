<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Entity\User;
use App\Form\AbsenceFormType;
use App\Service\AbsenceHistoricalServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Service\CalendarServiceInterface;
use Symfony\Component\Security\Core\Security;

class PdfGenerator extends AbstractController
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
    )
    {
        $this->calendarService = $calendarService;
        $this->absenceHistoricalService = $absenceHistoricalService;
    }

    /**
     * @param Security $security
     * @param Request $request
     *
     * @Route("pdf/{dateFormat}", name="app_pdf")
     */
    public function generatePdf(Security $security, Request $request)
    {
        $absence = new Absence();

        $form = $this->createForm(AbsenceFormType::class, $absence);
        $form->handleRequest($request);

        $user = $security->getUser();

        if ($user instanceof User) {
            $absence->setUser($user);
        }

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('calendar/exportCalendar.html.twig', [
            'absencesHistorical' => $this->absenceHistoricalService->getAbsenceHistoricalFromUser($user),
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("export.pdf", [
            "Attachment" => true
        ]);
    }
}
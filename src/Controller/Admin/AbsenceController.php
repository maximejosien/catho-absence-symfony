<?php

namespace App\Controller\Admin;

use App\Entity\Absence;
use App\Repository\AbsenceRepository;
use App\Service\AbsenceServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbsenceController extends AbstractController
{
    /**
     * @Route("/admin/absences", name="app_admin_absences")
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @param AbsenceRepository $absenceRepository
     *
     * @return Response
     */
    public function absencesList(AbsenceRepository $absenceRepository)
    {
        return $this->render("admin/absences.html.twig", [
            'absences' => $absenceRepository->findBy([], [
                'id' => 'DESC'
            ])
        ]);
    }

    /**
     * @Route("/admin/absences/accept/{absenceId}", name="app_admin_absences_accept")
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @param AbsenceServiceInterface $absenceService
     * @param string $absenceId
     *
     * @return RedirectResponse
     */
    public function accept(AbsenceServiceInterface $absenceService, string $absenceId)
    {
        $absenceService->acceptAbsenceWithId($absenceId);

        return $this->redirectToRoute('app_admin_absences');
    }

    /**
     * @Route("/admin/absences/refuse/{absenceId}", name="app_admin_absences_refuse")
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @param AbsenceServiceInterface $absenceService
     * @param string $absenceId
     *
     * @return RedirectResponse
     */
    public function refuse(AbsenceServiceInterface $absenceService, string $absenceId)
    {
        $absenceService->refuseAbsenceWithId($absenceId);

        return $this->redirectToRoute('app_admin_absences');
    }
}

<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Form\AbsenceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbsenceController extends AbstractController
{
    /**
     * @Route("/absence/add", name="app_absence_add")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request)
    {
        $absence = new Absence();

        $form = $this->createForm(AbsenceFormType::class, $absence);

        return $this->render('absence/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ERPController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     *
     * @return Response
     */
    public function home()
    {
        return $this->render('home/home.html.twig');
    }
}

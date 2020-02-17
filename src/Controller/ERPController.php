<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ERPController extends AbstractController
{
    /**
     * @Route("/index")
     *
     * @return Response
     */
    public function index()
    {
        return new Response(200);
    }
}

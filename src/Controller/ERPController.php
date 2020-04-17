<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ERPController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     *
     * @return Response
     */
    public function home(Security $security)
    {
        $user = $security->getUser();

        if ($user instanceof User) {
            return $this->redirectToRoute('app_calendar', [
                'dateFormat' => (new \DateTime())->format('F-Y')
            ]);
        }

        return $this->redirectToRoute('app_login');
    }
}

<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="app_admin_users")
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function usersList(UserRepository $userRepository)
    {
        return $this->render("admin/users.html.twig", [
            'users' => $userRepository->findAll()
        ]);
    }
}

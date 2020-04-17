<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    /**
     * List of Users
     *u
     * @route("/users", name="users")
     */
    public function usersList(\App\Repository\UserRepository $users)
    {
        return $this->render("admin/users.html.twig", [
            'users' => $users->findAll()
        ]);
    }
}
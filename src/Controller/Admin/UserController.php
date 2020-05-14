<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

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

    /**
     * @Route("/admin/absences/{id}", name="app_admin_absences_edit")
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @param User $user
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return RedirectResponse|Response
     */
    public function editUser(User $user, Request $request, TranslatorInterface $translator) {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $message = $translator->trans('User modified successfully');

            $this->addFlash('message', $message);
            return $this->redirectToRoute('app_admin_users');
        }

        return $this->render('admin/editUsers.html.twig', [
            'userForm' => $form->createView()
        ]);

    }

}

<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="login")
     */
    public function index(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();

        if ($this->getUser()) {
            return $this->redirectToRoute('projects_management');
        }

        return $this->render('admin/login.html.twig', [
            'error' => $error,
        ]);
    }
}
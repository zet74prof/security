<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AccessControlTestController extends AbstractController
{
    #[Route('/anonymous', name: 'app_access_control_anonymous')]
    public function anonymous(): Response
    {
        return $this->render('access_control_test/index.html.twig', [
        ]);
    }

    #[Route('/admin', name: 'app_access_control_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function admin(): Response
    {
        return $this->render('access_control_test/index.html.twig', [
        ]);
    }

    #[Route('/superadmin', name: 'app_access_control_superadmin')]
    public function superadmin(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        return $this->render('access_control_test/index.html.twig', [
        ]);
    }

    #[Route('/user', name: 'app_access_control_user')]
    public function index(): Response
    {
        return $this->render('access_control_test/index.html.twig', [
        ]);
    }
}

<?php

// src/Controller/AuthController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class AuthController extends AbstractController
{

       #[Route('/auth/google', name: 'auth_google', methods: ['POST'])]
    public function googleLogin(): JsonResponse
    {
        return new JsonResponse(['message' => 'Authenticating...']);
    }

    #[Route('/delete-account', name: 'delete_account', methods: ['DELETE'])]
    public function deleteAccount(EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        $em->remove($user);
        $em->flush();

        return new JsonResponse(['message' => 'Account deleted']);
    }
}
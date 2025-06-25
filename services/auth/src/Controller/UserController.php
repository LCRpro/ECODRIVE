<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    #[Route('/me', name: 'user_me', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function me(): JsonResponse
    {
        $user = $this->getUser();

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'roles' => $user->getRoles(),
        ]);
    }

    #[Route('/delete-account', name: 'delete_account', methods: ['DELETE'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function deleteAccount(EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        $em->remove($user);
        $em->flush();

        return new JsonResponse(['message' => 'Account deleted']);
    }
}


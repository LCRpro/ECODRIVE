<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;


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
    'birthday' => $user->getBirthday()?->format('Y-m-d'),
    'gender' => $user->getGender(),
    'address' => $user->getAddress(),
]);
    }

#[Route('/me', name: 'user_update', methods: ['PATCH'])]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
public function updateMe(Request $request, EntityManagerInterface $em): JsonResponse
{
    $user = $this->getUser();
    $data = json_decode($request->getContent(), true);

    if (isset($data['name'])) {
        $user->setName($data['name']);
    }

    if (isset($data['roles']) && is_array($data['roles'])) {
        $user->setRoles($data['roles']);
    }

    if (isset($data['birthday'])) {
        try {
            $user->setBirthday(new \DateTime($data['birthday']));
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid date format. Use YYYY-MM-DD.'], 400);
        }
    }

    if (isset($data['gender'])) {
        $user->setGender($data['gender']);
    }

    if (isset($data['address'])) {
        $user->setAddress($data['address']);
    }

    $em->flush();

    return new JsonResponse(['message' => 'Profile updated']);
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


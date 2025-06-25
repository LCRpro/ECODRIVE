<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthTest extends WebTestCase
{
    public function testGoogleLoginWithValidToken(): void
    {
        $client = static::createClient();
        $container = static::getContainer();

        $mock = $this->createMock(\App\Service\GoogleOAuthService::class);
        $mock->method('verify')->willReturn([
            'email' => 'test@example.com',
            'sub' => 'fake-sub-id',
            'name' => 'Test User'
        ]);
        $container->set(\App\Service\GoogleOAuthService::class, $mock);

        $client->request(
            'POST',
            '/auth/google',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['id_token' => 'faketoken'])
        );

        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $response);
    }

    public function testDeleteAccount(): void
    {
        $client = static::createClient();
        $container = static::getContainer();

   $em = $container->get('doctrine')->getManager();
$repo = $em->getRepository(User::class);

$user = $repo->findOneBy(['email' => 'delete@example.com']);

if (!$user) {
    $user = new User();
    $user->setEmail('delete@example.com');
    $user->setGoogleId('delete-sub');
    $user->setName('Delete Me');
    $user->setRoles(['ROLE_USER']);
    $em->persist($user);
    $em->flush();
    $em->refresh($user);
}

$user = $repo->findOneBy(['email' => 'delete@example.com']);
$this->assertNotNull($user->getUserIdentifier());
$jwt = $container->get(JWTTokenManagerInterface::class)->create($user);

        $client->request(
            'DELETE',
            '/delete-account',
            [],
            [],
            ['HTTP_Authorization' => 'Bearer ' . $jwt]
        );

        $this->assertResponseIsSuccessful();
        $em->clear(); 
        $deleted = $em->getRepository(User::class)->findOneBy(['email' => 'delete@example.com']);
        $this->assertNull($deleted);
    }
}
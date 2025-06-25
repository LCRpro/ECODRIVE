<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class UserTest extends WebTestCase
{
    public function testMeRequiresAuth(): void
    {
        $client = static::createClient();
        $client->request('GET', '/me');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testMeReturnsUserData(): void
    {
        $client = static::createClient();
        $container = static::getContainer();

        $em = $container->get('doctrine')->getManager();
        $repo = $em->getRepository(User::class);

        $user = $repo->findOneBy(['email' => 'me@example.com']);

        if (!$user) {
            $user = new User();
            $user->setEmail('me@example.com');
            $user->setGoogleId('me-sub');
            $user->setName('Test Me');
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();
            $em->refresh($user);
        }

        $jwt = $container->get(JWTTokenManagerInterface::class)->create($user);

        $client->request(
            'GET',
            '/me',
            [],
            [],
            ['HTTP_Authorization' => 'Bearer ' . $jwt]
        );

        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertSame('me@example.com', $response['email']);
        $this->assertSame('Test Me', $response['name']);
    }
}
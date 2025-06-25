<?php

// src/Security/GoogleAuthenticator.php

namespace App\Security;

use App\Service\GoogleOAuthService;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class GoogleAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private GoogleOAuthService $google,
        private UserRepository $users,
        private JWTTokenManagerInterface $jwtManager
    ) {}

    public function supports(Request $request): ?bool
    {
        return $request->getPathInfo() === '/auth/google' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): SelfValidatingPassport
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['id_token'])) {
            throw new \InvalidArgumentException('Missing id_token');
        }

        $payload = $this->google->verify($data['id_token']);
        $user = $this->users->findOrCreateFromGoogle($payload['sub'], $payload['email'], $payload['name'] ?? null);

        return new SelfValidatingPassport(new UserBadge($user->getEmail(), fn() => $user));
    }

    public function onAuthenticationSuccess(Request $request, $token, string $firewallName): \Symfony\Component\HttpFoundation\Response
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse([
            'token' => $this->jwtManager->create($token->getUser())
        ]);
    }

    public function onAuthenticationFailure(Request $request, \Symfony\Component\Security\Core\Exception\AuthenticationException $exception): \Symfony\Component\HttpFoundation\Response
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse(['error' => 'Authentication failed'], 401);
    }
}   
<?php


namespace App\Service;

class GoogleOAuthService
{
    public function verify(string $idToken): array
    {
        $client = new \Google_Client(['client_id' => $_ENV['GOOGLE_CLIENT_ID']]);
        $payload = $client->verifyIdToken($idToken);
        if (!$payload) {
            throw new \Exception('Invalid Google ID token.');
        }

        return $payload;
    }
}
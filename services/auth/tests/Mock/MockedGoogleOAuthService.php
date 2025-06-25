<?php

namespace App\Tests\Mock;

use App\Service\GoogleOAuthService;

class MockedGoogleOAuthService extends GoogleOAuthService
{
    public function verify(string $idToken): array
    {
        return [
            'email' => 'googleuser@example.com',
            'sub' => 'google-sub-id-123',
            'name' => 'Google User'
        ];
    }
}
<?php

namespace App\Infrastructure\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class JwtService implements JwtServiceInterface
{
    public function attempt(array $credentials): ?string
    {
        return JWTAuth::attempt($credentials);
    }
}

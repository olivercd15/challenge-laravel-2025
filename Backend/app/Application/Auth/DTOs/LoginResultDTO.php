<?php

namespace App\Application\Auth\DTOs;

class LoginResultDTO
{
    public function __construct(
        public readonly string $token,
        public readonly string $tokenType = 'bearer',
        public readonly int $expiresIn = 3600
    ) {}
}

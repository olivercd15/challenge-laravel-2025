<?php

namespace App\Application\Auth\DTOs;

class RegisterResultDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $status
    ) {}
}

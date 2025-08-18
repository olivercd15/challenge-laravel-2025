<?php

namespace App\Application\Auth\Commands\RegisterUser;

class RegisterUserCommand
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {}
}

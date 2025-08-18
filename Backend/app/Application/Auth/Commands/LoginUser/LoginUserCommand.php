<?php

namespace App\Application\Auth\Commands\LoginUser;

class LoginUserCommand
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}

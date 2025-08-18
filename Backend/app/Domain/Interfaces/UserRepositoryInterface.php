<?php

namespace App\Domain\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data);
    public function findByEmail(string $email): ?User;
}

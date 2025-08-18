<?php

namespace App\Domain\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data);
    public function findByEmail(string $email): ?User;
}

<?php

namespace App\Infrastructure\Services;

interface JwtServiceInterface
{
    /**
     * Intenta autenticar con email y password y devuelve el token.
     *
     * @param array $credentials
     * @return string|null
     */
    public function attempt(array $credentials): ?string;
}

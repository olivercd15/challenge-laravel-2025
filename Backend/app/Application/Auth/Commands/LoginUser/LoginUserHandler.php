<?php

namespace App\Application\Auth\Commands\LoginUser;

use App\Application\Auth\DTOs\LoginResultDTO;
use App\Infrastructure\Services\JwtServiceInterface;
use Illuminate\Validation\ValidationException;


class LoginUserHandler
{
    public function __construct(private JwtServiceInterface $jwt) {}

    public function handle(LoginUserCommand $cmd): LoginResultDTO
    {
        $token = $this->jwt->attempt([
            'email' => $cmd->email,
            'password' => $cmd->password,
        ]);

        if (!$token) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales inválidas.'],
            ]);
        }

        $tokenKey = "user_token:{$cmd->email}";
        cache()->put($tokenKey, $token, 3600);

        return new LoginResultDTO($token);
    }
}

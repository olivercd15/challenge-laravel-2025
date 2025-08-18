<?php

namespace App\Application\Auth\Commands\RegisterUser;

use App\Application\Auth\DTOs\RegisterResultDTO;
use App\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

class RegisterUserHandler
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function handle(RegisterUserCommand $cmd): RegisterResultDTO
    {
        $user = $this->userRepository->findByEmail($cmd->email);

        if ($user) {
            throw ValidationException::withMessages([
                'email' => 'El correo ya está registrado.',
            ]);
        }

        $user = $this->userRepository->register([
            'name' => $cmd->name,
            'email' => $cmd->email,
            'password' => bcrypt($cmd->password),
        ]);

        return new RegisterResultDTO($user->name, $user->email, 'Created!');
    }
}

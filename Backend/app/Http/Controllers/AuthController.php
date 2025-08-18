<?php

namespace App\Http\Controllers;

use App\Application\Auth\Commands\RegisterUser\RegisterUserCommand;
use App\Application\Auth\Validators\LoginUserValidator;
use App\Application\Auth\Commands\LoginUser\LoginUserCommand;
use App\Application\Auth\Commands\LoginUser\LoginUserHandler;
use App\Application\Auth\Commands\RegisterUser\RegisterUserHandler;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __construct(private LoginUserHandler $handler){}

    public function register(RegisterUserRequest $request, RegisterUserHandler $handler)
    {
        $command = new RegisterUserCommand(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
        );

        $result = $handler->handle($command);

        return response()->json($result);
    }

    public function login(Request $request)
    {
        $data = LoginUserValidator::validate($request->all());

        $command = new LoginUserCommand(
            $data['email'],
            $data['password']
        );

        $result = $this->handler->handle($command);

        return response()->json($result);
    }



}

<?php

namespace App\Http\Controllers;

use App\Application\Auth\Validators\LoginUserValidator;
use App\Application\Auth\Commands\LoginUser\LoginUserCommand;
use App\Application\Auth\Commands\LoginUser\LoginUserHandler;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __construct(private LoginUserHandler $handler){}

    public function login(Request $request)
    {
        $data = LoginUserValidator::validate($request->all());

        $cmd = new LoginUserCommand(
            $data['email'],
            $data['password']
        );

        $result = $this->handler->handle($cmd);

        return response()->json($result);
    }



}

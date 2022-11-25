<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterUserRequest;
use Packages\Service\User\Command\RegisterUserService;

class UserController extends Controller
{
    private RegisterUserService $registerUserService;

    public function __construct(RegisterUserService $registerUserService)
    {
        $this->registerUserService = $registerUserService;
    }

    public function registerUser(RegisterUserRequest $request): void
    {
        $this->registerUserService->register($request->ofDomain());
    }
}

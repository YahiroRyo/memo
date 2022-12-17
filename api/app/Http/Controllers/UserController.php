<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterUserRequest;
use Packages\Service\User\Command\AuthUserService;
use Packages\Service\User\Command\RegisterUserService;

class UserController extends Controller
{
    private RegisterUserService $registerUserService;
    private AuthUserService $authUserService;

    public function __construct(
        RegisterUserService $registerUserService,
        AuthUserService $authUserService
    ) {
        $this->registerUserService = $registerUserService;
        $this->authUserService     = $authUserService;
    }

    public function registerUser(RegisterUserRequest $request): void
    {
        $this->registerUserService->register($request->fromDomain());
    }

    public function login(LoginRequest $request): array
    {
        return $this->authUserService->login($request->fromDomain())->ofJson();
    }

    public function logout(): void
    {
        $this->authUserService->logout();
    }
}

<?php

namespace Tests\Feature\User;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterUserRequest;

class LoginUserTest extends UserTestCase
{
    public function test_ログインを行えること(): void
    {
        $userRegisterRequest = new RegisterUserRequest([
            'email'     => 'a@a.aa',
            'password'  => 'password',
        ]);

        $response = $this->post('/users', $userRegisterRequest->all());
        $response->assertOk();

        $userLoginRequest = new LoginRequest($userRegisterRequest->all());
        $response = $this->post('/users/login', $userLoginRequest->all());
        $response->assertOk();
    }

    public function test_ログインに失敗すること(): void
    {
        $userRegisterRequest = new RegisterUserRequest([
            'email'     => 'a@a.aa',
            'password'  => 'password',
        ]);

        $response = $this->post('/users', $userRegisterRequest->all());
        $response->assertOk();

        $userLoginRequest = new LoginRequest([
            'email'     => 'b@a.aa',
            'password'  => 'password',
        ]);
        $response = $this->post('/users/login', $userLoginRequest->all());
        $response->assertStatus(401);
    }
}

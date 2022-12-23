<?php

namespace Tests\Feature\User;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterUserRequest;
use Packages\Infrastructure\Eloquents\User\User;

class LogoutUserTest extends UserTestCase
{
    public function test_ログアウトを行えること(): void
    {
        $userRegisterRequest = new RegisterUserRequest([
            'email'     => 'a@a.aa',
            'password'  => 'password',
        ]);

        $response = $this->post('/users/register', $userRegisterRequest->all());
        $response->assertOk();

        $userLoginRequest = new LoginRequest($userRegisterRequest->all());
        $loginResponse = $this->post('/users/login', $userLoginRequest->all());
        $loginResponse->assertOk();

        $logoutResponse = $this->post('/users/logout');
        $logoutResponse->assertOk();
    }
}

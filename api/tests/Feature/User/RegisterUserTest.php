<?php

namespace Tests\Feature\User;

use App\Http\Requests\User\RegisterUserRequest;
use Packages\Infrastructure\Eloquents\User\User;

class RegisterUserTest extends UserTestCase
{
    public function test_ユーザー作成を行えること(): void
    {
        $request = new RegisterUserRequest([
            'email'     => 'a@a.aa',
            'password'  => 'password',
        ]);

        $response = $this->post('/users/register', $request->all());
        $response->assertOk();
        $this->assertTrue(User::where('email', $request['email'])->exists());
    }
}

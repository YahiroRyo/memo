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

        $response = $this->post('/users', $request->all());
        $response->assertOk();
        $this->assertTrue(User::where('email', $request['email'])->exists());
    }

    public function test_ユーザーが存在した場合作成できないこと(): void
    {
        $this->test_ユーザー作成を行えること();

        $request = new RegisterUserRequest([
            'email'     => 'b@a.aa',
            'password'  => 'password',
        ]);

        $response = $this->post('/users', $request->all());
        $response->assertStatus(500);
    }
}

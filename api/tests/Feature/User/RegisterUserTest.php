<?php

namespace Tests\Feature\User;

use Packages\Infrastructure\Eloquents\User;

class RegisterUserTest extends UserTestCase
{
    public function test_ユーザー作成を行えること(): void
    {
        $request = [
            'email'     => 'a@a.aa',
            'password'  => 'password',
        ];

        $response = $this->post('/users', $request);
        $response->assertOk();
        $this->assertTrue(User::where('email', $request['email'])->exists());
    }

    public function test_ユーザーが存在した場合作成できないこと(): void
    {
        $this->test_ユーザー作成を行えること();

        $request = [
            'email'     => 'b@a.aa',
            'password'  => 'password',
        ];

        $response = $this->post('/users', $request);
        $response->assertStatus(500);
    }
}

<?php

namespace Packages\Infrastructure\Repositories\User;

use Illuminate\Validation\UnauthorizedException;
use Packages\Domain\User\Entities\UserForLogin;
use Packages\Domain\User\ValueObjects\Token;

final class AuthUserRepository
{
    public function login(UserForLogin $userForLogin): Token
    {
        if (auth()->attempt($userForLogin->ofJson())) {
            return Token::from(request()->user()->createToken('token')->plainTextToken);
        }

        throw new UnauthorizedException('ログインに失敗しました。フォームを確認の上、もう一度お試しください。');
    }

    public function logout(): void
    {
        /** @var mixed */
        $user = auth()->guard('sanctum')->user();
        $user->tokens()->delete();
    }
}

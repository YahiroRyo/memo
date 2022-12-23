<?php

namespace Packages\Infrastructure\Repositories\User;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;
use Packages\Domain\User\Entities\InitUser;
use Packages\Domain\User\ValueObjects\Token;
use Packages\Exceptions\User\FailRegisterUserException;

final class RegisterUserRepository
{
    public function register(InitUser $initUser): Token
    {
        return DB::transaction(function () use ($initUser): Token {
            $isSuccess = DB::insert('
                INSERT INTO users (
                    email,
                    password,
                    created_at
                )
                VALUES (?, ?, ?)
            ', [
                $initUser->email()->value(),
                $initUser->password()->hashPassword(),
                CarbonImmutable::now()
            ]);

            if (!$isSuccess) {
                throw new FailRegisterUserException();
            }

            if (auth()->attempt($initUser->ofJson())) {
                return Token::from(request()->user()->createToken('token')->plainTextToken);
            }

            throw new UnauthorizedException('ログインに失敗しました。フォームを確認の上、もう一度お試しください。');
        });
    }
}

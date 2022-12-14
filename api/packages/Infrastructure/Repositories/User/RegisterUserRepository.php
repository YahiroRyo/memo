<?php

namespace Packages\Infrastructure\Repositories\User;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Packages\Domain\User\Entities\InitUser;
use Packages\Exceptions\User\FailRegisterUserException;

final class RegisterUserRepository
{
    public function register(InitUser $initUser): void
    {
        DB::transaction(function () use ($initUser): void {
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
        });
    }
}

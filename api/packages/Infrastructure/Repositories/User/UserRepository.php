<?php

namespace Packages\Infrastructure\Repositories\User;

use Illuminate\Support\Facades\DB;
use Packages\Domain\User\Entities\User;
use Packages\Domain\User\Entities\UserList;
use Packages\Domain\User\ValueObjects\Email;
use Packages\Domain\User\ValueObjects\UserId;

final class UserRepository
{
    public function users(): UserList
    {
        $result = UserList::from([]);

        $users = DB::select('
            SELECT
                user_id,
                email
            FROM
                users
        ');
        foreach ($users as $user) {
            $result = $result->add(new User(
                UserId::throwIfValidErrorFrom($user->user_id),
                Email::throwIfValidErrorFrom($user->email)
            ));
        }

        return $result;
    }

    public function userBySessionId(): User
    {
        $laravelUser = auth()->user();

        return new User(
            UserId::throwIfValidErrorFrom($laravelUser->user_id),
            Email::throwIfValidErrorFrom($laravelUser->email)
        );
    }
}

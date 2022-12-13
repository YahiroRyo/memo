<?php

namespace Packages\Infrastructure\Repositories\User;

use Illuminate\Support\Facades\DB;
use Packages\Domain\User\Entities\User;
use Packages\Domain\User\Entities\UserList;
use Packages\Domain\User\ValueObjects\Email;

final class UserRepository
{
    public function users(): UserList
    {
        $result = UserList::from([]);

        $users = DB::select('
            SELECT
                email
            FROM
                users
        ');
        foreach ($users as $user) {
            $result = $result->add(new User(
                Email::throwIfValidErrorFrom($user->email)
            ));
        }

        return $result;
    }
}

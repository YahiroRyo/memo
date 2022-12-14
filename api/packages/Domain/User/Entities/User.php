<?php

namespace Packages\Domain\User\Entities;

use Packages\Domain\User\ValueObjects\Email;
use Packages\Domain\User\ValueObjects\UserId;

final class User
{
    private UserId $userId;
    private Email $email;

    public function __construct(UserId $userId, Email $email)
    {
        $this->userId = $userId;
        $this->email  = $email;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function email(): Email
    {
        return $this->email;
    }
}

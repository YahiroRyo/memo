<?php

namespace Packages\Domain\User\Entities;

use Packages\Domain\User\ValueObjects\Email;

final class User {
    private Email $email;

    public function __construct(Email $email) {
        $this->email = $email;
    }

    public function email(): Email {
        return $this->email;
    }
}

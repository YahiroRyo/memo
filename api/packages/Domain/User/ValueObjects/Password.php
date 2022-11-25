<?php

namespace Packages\Domain\User\ValueObjects;

use Packages\Domain\StringLengthLimit;

final class Password extends StringLengthLimit {
    protected string $name = 'パスワード';
    protected int $minLengthLimit = 6;
    protected int $maxLengthLimit = 255;

    public function hashPassword(): string {
        return bcrypt($this->value);
    }
}

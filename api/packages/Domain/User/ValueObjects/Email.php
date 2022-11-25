<?php

namespace Packages\Domain\User\ValueObjects;

use Packages\Domain\StringLengthLimit;
use Packages\Domain\Validator\Entities\ValidationFactory;

final class Email extends StringLengthLimit {
    protected string $name = 'メールアドレス';
    protected int $minLengthLimit = 0;
    protected int $maxLengthLimit = 255;

    public static function of($value): static {
        ValidationFactory::make(
            ['メールアドレス' => $value],
            ['メールアドレス' => ['email']]
        )->validate();

        return parent::of($value);
    }
}

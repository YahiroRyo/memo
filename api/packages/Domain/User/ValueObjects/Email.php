<?php

namespace Packages\Domain\User\ValueObjects;

use Illuminate\Support\Facades\Validator;
use Packages\Domain\StringLengthLimit;

final class Email extends StringLengthLimit
{
    protected string $name = 'メールアドレス';
    protected int $minLengthLimit = 0;
    protected int $maxLengthLimit = 255;

    public static function of($value): static
    {
        Validator::make(
            ['メールアドレス' => $value],
            ['メールアドレス' => ['email']]
        )->validate();

        return parent::of($value);
    }
}

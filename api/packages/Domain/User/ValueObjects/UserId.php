<?php

namespace Packages\Domain\User\ValueObjects;

use Packages\Domain\PositiveNumber;

final class UserId extends PositiveNumber
{
    protected string $name = 'ユーザーの識別番号';
}

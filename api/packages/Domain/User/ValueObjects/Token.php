<?php

namespace Packages\Domain\User\ValueObjects;

use Packages\Domain\StringLengthLimit;

final class Token extends StringLengthLimit
{
    protected string $name = '認証情報';
    protected int $maxLengthLimit = 255;

    public function ofJson(): array
    {
        return ['token' => $this->value];
    }
}

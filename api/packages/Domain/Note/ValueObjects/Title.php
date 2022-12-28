<?php

namespace Packages\Domain\Note\ValueObjects;

use Packages\Domain\StringLengthLimit;

final class Title extends StringLengthLimit
{
    protected string $name = 'タイトル';
    protected int $minLengthLimit = 1;
    protected int $maxLengthLimit = 500000;
}

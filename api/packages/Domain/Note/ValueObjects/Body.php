<?php

namespace Packages\Domain\Note\ValueObjects;

use Packages\Domain\StringLengthLimit;

final class Body extends StringLengthLimit
{
    protected string $name = 'ボディー';
    protected int $minLengthLimit = 0;
    protected int $maxLengthLimit = 5000000;
}

<?php

namespace Packages\Domain\Note\ValueObjects;

use Packages\Domain\StringLengthLimit;

final class Body extends StringLengthLimit
{
    protected string $name = 'ボディー';
    protected int $maxLengthLimit = 5000000;
}

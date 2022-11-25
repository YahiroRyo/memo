<?php

namespace Packages\Domain\Validator\ValueObjects;

enum ErrorMode: string
{
    case STACK = 'stack';
    case THROW = 'throw';

    public function isStackErrors(): bool
    {
        return $this === ErrorMode::STACK;
    }

    public function isThrowErrors(): bool
    {
        return $this === ErrorMode::THROW;
    }
}

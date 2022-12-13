<?php

namespace Packages\Domain\Error\Entities;

use Illuminate\Validation\ValidationException;
use Packages\Domain\Domainable;

final class Errors
{
    private array $errors = [];

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function isEmpty(): bool
    {
        return count($this->errors) === 0;
    }

    public function addIfError(Domainable $valueObject): Errors
    {
        if ($valueObject->isValidationFail()) {
            return new Errors(array_merge(
                $this->errors,
                $valueObject->validatedMessages()
            ));
        }

        return new Errors($this->errors);
    }

    /** @throws ValidationException */
    public function throwIf(): void
    {
        if ($this->isEmpty()) {
            return;
        }

        throw ValidationException::withMessages($this->errors);
    }
}

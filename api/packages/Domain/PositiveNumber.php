<?php

namespace Packages\Domain;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PositiveNumber implements DomainModel
{
    protected readonly int $value;
    protected string $name;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public function isEmpty(): bool
    {
        return $this->value === 0;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isValidationFail(): bool
    {
        return count($this->validatedMessages()) !== 0;
    }

    public function validatedMessages(): array
    {
        return Validator::make(
            [$this->name => $this->value],
            [$this->name => ["min:0"]],
            [$this->name => [
                'min'       => ':attributeは正数でなければなりません。',
            ]]
        )->messages()->toArray();
    }

    public static function from($value): static
    {
        $valueObject = new static($value);

        if ($valueObject->isValidationFail()) {
            throw ValidationException::withMessages($valueObject->validatedMessages());
        }

        return $valueObject;
    }

    public static function unsafetyFrom($value): static
    {
        return new static($value);
    }
}

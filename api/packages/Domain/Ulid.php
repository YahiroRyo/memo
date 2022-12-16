<?php

namespace Packages\Domain;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Ulid implements DomainModel
{
    protected readonly string $value;
    protected string $name;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public function value(): string
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
            [$this->name => ["string", "min:26", "max:26"]],
            [$this->name => [
                'string'    => ':attributeは文字でなければなりません。',
                'min'       => ':attributeの長さは:minでなければなりません。',
                'max'       => ':attributeの長さは:maxでなければなりません。',
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

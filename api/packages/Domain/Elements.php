<?php

namespace Packages\Domain;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Elements implements Domainable
{
    protected array $value;
    protected string $name;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public function add($value): static
    {
        return new static(array_merge($this->value, [$value]));
    }

    public function reset(): static
    {
        return new static([]);
    }

    public function isEmpty(): bool
    {
        return count($this->value) === 0;
    }

    public function isValidationFail(): bool
    {
        return count($this->validatedMessages()) !== 0;
    }

    public function value(): array
    {
        return $this->value;
    }

    public function validatedMessages(): array
    {
        return Validator::make(
            [$this->name => $this->value],
            [$this->name => ['array']],
            [$this->name => [
                'array'  => ':attributeは配列でなければなりません。',
            ]]
        )->messages()->toArray();
    }

    public static function from($value): static
    {
        return new static($value);
    }

    public static function throwIfValidErrorFrom($value): static
    {
        $valueObject = new static($value);

        if ($valueObject->isValidationFail()) {
            throw ValidationException::withMessages($valueObject->validatedMessages());
        }

        return $valueObject;
    }
}

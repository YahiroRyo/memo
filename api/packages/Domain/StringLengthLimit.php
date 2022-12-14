<?php

namespace Packages\Domain;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StringLengthLimit implements Domainable
{
    protected readonly string $value;
    protected string $name;
    protected int $minLengthLimit = 0;
    protected int $maxLengthLimit;

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
        $validateRules = ["string", "min:{$this->minLengthLimit}", "max:{$this->maxLengthLimit}"];

        if ($this->minLengthLimit >= 1) {
            $validateRules[] = "required";
        }

        return Validator::make(
            [$this->name => $this->value],
            [$this->name => $validateRules],
            [$this->name => [
                'required'   => ':attributeは必須項目です。',
                'string'    => ':attributeは文字でなければなりません。',
                'min'       => ':attributeの長さは:min未満です。',
                'max'       => ':attributeの長さは:maxを超過しています。',
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

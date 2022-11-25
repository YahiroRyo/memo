<?php

namespace Packages\Domain;

use Packages\Domain\Validator\Entities\ValidationFactory;

abstract class StringLengthLimit
{
    protected string $value;
    protected string $name;
    protected int $minLengthLimit = 0;
    protected int $maxLengthLimit;

    private function __construct($value)
    {
        $validateRules = ["string", "min:{$this->minLengthLimit}", "max:{$this->maxLengthLimit}"];

        if ($this->minLengthLimit >= 1) {
            $validateRules[] = "required";
        }

        ValidationFactory::make(
            [$this->name => $value],
            [$this->name => $validateRules],
            [$this->name => [
                'required'   => ':attributeは必須項目です。',
                'string'    => ':attributeは文字でなければなりません。',
                'min'       => ':attributeの長さは:min未満です。',
                'max'       => ':attributeの長さは:maxを超過しています。',
            ]]
        )->validate();

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function of($value): static
    {
        return new static($value);
    }
}

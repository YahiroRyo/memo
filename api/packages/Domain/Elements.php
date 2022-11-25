<?php

namespace Packages\Domain;

use Packages\Domain\Validator\Entities\ValidationFactory;

abstract class Elements
{
    protected array $value;
    protected string $name;

    private function __construct($value)
    {
        ValidationFactory::make(
            [$this->name => $value],
            [$this->name => ['array']],
            [$this->name => [
                'array'  => ':attributeは配列でなければなりません。',
            ]]
        )->validate();

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

    public function value(): array
    {
        return $this->value;
    }

    public static function of($value): static
    {
        return new static($value);
    }
}

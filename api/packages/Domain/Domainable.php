<?php

namespace Packages\Domain;

interface Domainable
{
    public function isValidationFail(): bool;
    public function validatedMessages(): array;
}

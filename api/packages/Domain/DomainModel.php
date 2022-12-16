<?php

namespace Packages\Domain;

interface DomainModel
{
    public function isValidationFail(): bool;
    public function validatedMessages(): array;
}

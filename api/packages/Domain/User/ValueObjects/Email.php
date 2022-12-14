<?php

namespace Packages\Domain\User\ValueObjects;

use Illuminate\Support\Facades\Validator;
use Packages\Domain\StringLengthLimit;

final class Email extends StringLengthLimit
{
    protected string $name = 'メールアドレス';
    protected int $minLengthLimit = 0;
    protected int $maxLengthLimit = 255;

    public function validatedMessages(): array
    {
        return array_merge(
            Validator::make(
                [$this->name => $this->value],
                [$this->name => ['email']],
                [$this->name => [
                    'email'  => 'メールアドレスのフォーマットが不正です'
                ]]
            )->messages()->toArray(),
            parent::validatedMessages(),
        );
    }
}

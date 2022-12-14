<?php

namespace Packages\Domain\Note\ValueObjects;

use Packages\Domain\PositiveNumber;

final class NonActiveNoteId extends PositiveNumber
{
    protected string $name = 'メモ削除済み識別番号';
}

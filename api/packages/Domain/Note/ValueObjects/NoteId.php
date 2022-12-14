<?php

namespace Packages\Domain\Note\ValueObjects;

use Packages\Domain\Ulid;

final class NoteId extends Ulid
{
    protected string $name = 'メモ識別番号';

    public function ofJson(): array {
        return ['noteId' => $this->value()];
    }
}

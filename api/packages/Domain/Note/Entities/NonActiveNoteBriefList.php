<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Elements;

final class NonActiveNoteBriefList extends Elements
{
    protected string $name = '削除済みのノート一覧';

    /** @return NonActiveNoteBrief[] */
    public function value(): array
    {
        return parent::value();
    }

    /** @return NonActiveNoteBrief */
    public function last(): mixed
    {
        return parent::last();
    }

    public function shouldDeleteEarliestNote(): bool
    {
        return $this->length() > 8;
    }
}

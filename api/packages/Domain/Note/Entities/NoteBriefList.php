<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Elements;

final class NoteBriefList extends Elements
{
    protected string $name = 'ノート一覧';

    /** @return NoteBrief[] */
    public function value(): array
    {
        return parent::value();
    }
}

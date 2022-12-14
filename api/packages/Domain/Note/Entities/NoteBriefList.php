<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Elements;

final class NoteBriefList extends Elements
{
    /** @return NoteBrief[] */
    public function value(): array
    {
        return parent::value();
    }
}

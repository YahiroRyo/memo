<?php

namespace Packages\Domain\Note\ValueObjects;

use Packages\Domain\PositiveNumber;

final class SearchNoteCount extends PositiveNumber
{
    protected string $name = 'ノート取得数';

    public static function elseDefaultZero(): SearchNoteCount
    {
        return SearchNoteCount::from(0);
    }
}

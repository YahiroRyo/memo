<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Note\ValueObjects\SearchKeyword;
use Packages\Domain\Note\ValueObjects\SearchNoteCount;

final class SearchNoteBriefList
{
    private SearchKeyword $keyword;
    private SearchNoteCount $noteCount;

    public function __construct(
        SearchKeyword $keyword,
        SearchNoteCount $noteCount
    ) {
        $this->keyword   = $keyword;
        $this->noteCount = $noteCount;
    }

    public function keyword(): SearchKeyword
    {
        return $this->keyword;
    }

    public function noteCount(): SearchNoteCount
    {
        return $this->noteCount;
    }
}

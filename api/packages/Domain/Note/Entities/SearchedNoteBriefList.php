<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Elements;
use Packages\Domain\Note\ValueObjects\SearchNoteCount;

final class SearchedNoteBriefList extends Elements
{
    private SearchNoteCount $noteCount;
    protected string $name = 'ノート一覧検索結果';

    private function __construct($value, SearchNoteCount $noteCount)
    {
        $this->value     = $value;
        $this->noteCount = $noteCount;
    }

    /** @return NoteBrief[] */
    public function value(): array
    {
        $noteBriefList = $this->takeNoteCount();

        return $noteBriefList->value();
    }

    public function takeNoteCount(): SearchedNoteBriefList
    {
        if ($this->noteCount->isEmpty()) {
            return SearchedNoteBriefList::fromNoteCount($this->value, $this->noteCount);
        }

        return $this->subList(0, $this->noteCount->value());
    }

    public function subList(int $startIndex, int $endIndex): SearchedNoteBriefList
    {
        $result = [];
        foreach ($this->value as $index => $noteBrief) {
            if ($index >= $startIndex && $index <= $endIndex) {
                $result[] = $noteBrief;
            }
        }
        return new SearchedNoteBriefList($result, $this->noteCount);
    }

    public function ofJson(): array
    {
        $result = [];
        foreach ($this->value as $noteBrief) {
            $result[] = $noteBrief->ofJson();
        }
        return $result;
    }

    public static function fromNoteCount($value, SearchNoteCount $noteCount): static
    {
        return new static($value, $noteCount);
    }
}

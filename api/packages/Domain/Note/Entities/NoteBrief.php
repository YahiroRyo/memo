<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\Note\ValueObjects\Title;

final class NoteBrief
{
    private readonly NoteId $noteId;
    private readonly Title $title;

    public function __construct(
        NoteId $noteId,
        Title $title,
    ) {
        $this->noteId = $noteId;
        $this->title = $title;
    }

    public function noteId(): NoteId
    {
        return $this->noteId;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function ofJson(): array
    {
        return [
            'noteId' => $this->noteId()->value(),
            'title'  => $this->title()->value(),
        ];
    }
}

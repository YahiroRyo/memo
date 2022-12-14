<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Note\ValueObjects\NonActiveNoteId;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\Note\ValueObjects\Title;

final class NonActiveNoteBrief
{
    private readonly NonActiveNoteId $nonActiveNoteId;
    private readonly NoteId $noteId;
    private readonly Title $title;

    public function __construct(
        NonActiveNoteId $nonActiveNoteId,
        NoteId $noteId,
        Title $title,
    ) {
        $this->nonActiveNoteId = $nonActiveNoteId;
        $this->noteId          = $noteId;
        $this->title           = $title;
    }

    public function nonActiveNoteId(): NonActiveNoteId
    {
        return $this->nonActiveNoteId;
    }

    public function noteId(): NoteId
    {
        return $this->noteId;
    }

    public function title(): Title
    {
        return $this->title;
    }
}

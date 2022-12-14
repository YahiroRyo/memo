<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Note\ValueObjects\Body;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\Note\ValueObjects\Title;

final class LatestNote
{
    private readonly NoteId $noteId;
    private readonly Title $title;
    private readonly Body $body;

    public function __construct(
        NoteId $noteId,
        Title $title,
        Body $body,
    ) {
        $this->noteId = $noteId;
        $this->title = $title;
        $this->body = $body;
    }

    public function noteId(): NoteId
    {
        return $this->noteId;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function body(): Body
    {
        return $this->body;
    }
}

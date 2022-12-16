<?php

namespace Packages\Infrastructure\Repositories\Note;

use Illuminate\Support\Facades\DB;
use Packages\Domain\Note\Entities\NonActiveNoteBrief;
use Packages\Domain\Note\Entities\NonActiveNoteBriefList;
use Packages\Domain\Note\ValueObjects\NonActiveNoteId;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\Note\ValueObjects\Title;

final class NonActiveNoteRepository
{
    public function noteList(): NonActiveNoteBriefList
    {
        $result = [];

        $notes = DB::select('
            SELECT
                id,
                note_id,
                title
            FROM
                non_active_notes
            ORDER BY
                created_at DESC
        ');

        foreach ($notes as $note) {
            $result[] = new NonActiveNoteBrief(
                NonActiveNoteId::from($note->id),
                NoteId::from($note->note_id),
                Title::from($note->title),
            );
        }

        return NonActiveNoteBriefList::from($result);
    }

    public function deleteEarliestNote(NonActiveNoteBriefList $noteList): void
    {
        $earliestNote = $noteList->last();

        DB::delete('
            DELETE FROM
                non_active_notes
            WHERE
                id = ?
        ', [$earliestNote->nonActiveNoteId()->value()]);
    }
}

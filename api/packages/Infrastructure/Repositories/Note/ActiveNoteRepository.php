<?php

namespace Packages\Infrastructure\Repositories\Note;

use Illuminate\Support\Facades\DB;
use Packages\Domain\Note\Entities\NoteBrief;
use Packages\Domain\Note\Entities\SearchedNoteBriefList;
use Packages\Domain\Note\Entities\SearchNoteBriefList;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\Note\ValueObjects\Title;

final class ActiveNoteRepository
{
    public function searchNoteList(SearchNoteBriefList $searchNoteBriefList): SearchedNoteBriefList
    {
        $result = [];

        $notes = DB::select('
            SELECT
                note_id,
                title
            FROM
                active_notes
            WHERE
                title LIKE ?
            OR
                body  LIKE ?
            ORDER BY
                created_at DESC
        ', $searchNoteBriefList->keyword()->generateLikeQueriesOfSql(2));

        foreach ($notes as $note) {
            $result[] = new NoteBrief(
                NoteId::from($note->note_id),
                Title::from($note->title),
            );
        }

        return SearchedNoteBriefList::fromNoteCount(
            $result,
            $searchNoteBriefList->noteCount()
        );
    }
}

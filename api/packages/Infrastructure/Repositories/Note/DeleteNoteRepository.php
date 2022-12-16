<?php

namespace Packages\Infrastructure\Repositories\Note;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Exceptions\Note\FailDeleteNoteException;

final class DeleteNoteRepository
{
    public function deleteNote(NoteId $noteId): void
    {
        DB::transaction(function () use ($noteId) {
            $preActiveNote = DB::selectOne('
                SELECT
                    note_id,
                    title,
                    body,
                    user_id,
                    created_at
                FROM
                    active_notes
                WHERE
                    note_id = ?
            ', [$noteId->value()]);

            DB::delete('
                DELETE FROM
                    active_notes
                WHERE
                    note_id = ?
            ', [$noteId->value()]);

            $isSuccess = DB::insert('
                INSERT INTO non_active_notes (
                    note_id,
                    title,
                    body,
                    user_id,
                    active_note_created_at,
                    created_at
                ) VALUES (?, ?, ?, ?, ?, ?)
            ', [
                $preActiveNote->note_id,
                $preActiveNote->title,
                $preActiveNote->body,
                $preActiveNote->user_id,
                $preActiveNote->created_at,
                new CarbonImmutable()
            ]);

            if (!$isSuccess) {
                throw new FailDeleteNoteException();
            }
        });
    }
}

<?php

namespace Packages\Infrastructure\Repositories\Note;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Packages\Domain\Note\Entities\LatestNote;
use Packages\Domain\Note\Entities\LatestNoteBrief;
use Packages\Domain\User\Entities\User;
use Packages\Exceptions\Note\FailEditNoteException;

final class EditNoteRepository
{
    public function editNote(LatestNote $latestNote, User $user): void
    {
        DB::transaction(function () use ($latestNote, $user) {
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
            ', [$latestNote->noteId()->value()]);

            DB::delete('
                DELETE FROM
                    active_notes
                WHERE
                    note_id = ?
            ', [$latestNote->noteId()->value()]);

            $isSuccess = DB::insert('
                INSERT INTO active_notes (
                    note_id,
                    user_id,
                    title,
                    body
                ) VALUES (?, ?, ?, ?)
            ', [
                $latestNote->noteId()->value(),
                $user->userId()->value(),
                $latestNote->title()->value(),
                $latestNote->body()->value(),
            ]);

            if (!$isSuccess) {
                throw new FailEditNoteException();
            }

            $isSuccess = DB::insert('
                INSERT INTO non_active_notes (
                    note_id,
                    user_id,
                    title,
                    body,
                    active_note_created_at,
                    created_at
                ) VALUES (?, ?, ?, ?, ?, ?)
            ', [
                $preActiveNote->note_id,
                $preActiveNote->user_id,
                $preActiveNote->title,
                $preActiveNote->body,
                $preActiveNote->created_at,
                new CarbonImmutable()
            ]);

            if (!$isSuccess) {
                throw new FailEditNoteException();
            }
        });
    }

    public function editNoteTitle(LatestNoteBrief $latestNoteBrief, User $user): void
    {
        DB::transaction(function () use ($latestNoteBrief, $user) {
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
            ', [$latestNoteBrief->noteId()->value()]);

            DB::delete('
                DELETE FROM
                    active_notes
                WHERE
                    note_id = ?
            ', [$latestNoteBrief->noteId()->value()]);

            $isSuccess = DB::insert('
                INSERT INTO active_notes (
                    note_id,
                    user_id,
                    title,
                    body
                ) VALUES (?, ?, ?, ?)
            ', [
                $latestNoteBrief->noteId()->value(),
                $user->userId()->value(),
                $latestNoteBrief->title()->value(),
                $preActiveNote->body,
            ]);

            if (!$isSuccess) {
                throw new FailEditNoteException();
            }

            $isSuccess = DB::insert('
                INSERT INTO non_active_notes (
                    note_id,
                    user_id,
                    title,
                    body,
                    active_note_created_at,
                    created_at
                ) VALUES (?, ?, ?, ?, ?, ?)
            ', [
                $preActiveNote->note_id,
                $preActiveNote->user_id,
                $preActiveNote->title,
                $preActiveNote->body,
                $preActiveNote->created_at,
                new CarbonImmutable()
            ]);

            if (!$isSuccess) {
                throw new FailEditNoteException();
            }
        });
    }
}

<?php

namespace Packages\Infrastructure\Repositories\Note;

use Illuminate\Support\Facades\DB;
use Packages\Domain\Note\Entities\InitNote;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\User\Entities\User;
use Packages\Exceptions\Note\FailRegisterNoteException;
use Rorecek\Ulid\Ulid;

final class RegisterNoteRepository
{
    public function registerNote(InitNote $initNote, User $user): NoteId {
        $noteId = (new Ulid())->generate();

        DB::transaction(function() use ($initNote, $user, $noteId) {
            $isSuccess = DB::insert('
                INSERT INTO notes (
                    note_id
                ) VALUES (?)
            ', [$noteId]);

            if (!$isSuccess) {
                throw new FailRegisterNoteException();
            }

            $isSuccess = DB::insert('
                INSERT INTO active_notes (
                    note_id,
                    user_id,
                    title,
                    body
                ) VALUES (?, ?, ?, ?)
            ', [
                $noteId,
                $user->userId()->value(),
                $initNote->title()->value(),
                $initNote->body()->value(),
            ]);

            if (!$isSuccess) {
                throw new FailRegisterNoteException();
            }
        });

        return NoteId::throwIfValidErrorFrom($noteId);
    }
}

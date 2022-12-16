<?php

namespace Packages\Service\Note\Command;

use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Infrastructure\Repositories\Note\DeleteNoteRepository;

final class DeleteNoteService
{
    private DeleteNoteRepository $deleteNoteRepository;

    public function __construct(DeleteNoteRepository $deleteNoteRepository)
    {
        $this->deleteNoteRepository = $deleteNoteRepository;
    }

    public function deleteNote(NoteId $noteId): void
    {
        $this->deleteNoteRepository->deleteNote($noteId);
    }
}

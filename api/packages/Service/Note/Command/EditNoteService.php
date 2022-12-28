<?php

namespace Packages\Service\Note\Command;

use Packages\Domain\Note\Entities\LatestNote;
use Packages\Domain\Note\Entities\LatestNoteBrief;
use Packages\Infrastructure\Repositories\Note\EditNoteRepository;
use Packages\Infrastructure\Repositories\Note\NonActiveNoteRepository;
use Packages\Infrastructure\Repositories\User\UserRepository;

final class EditNoteService
{
    private UserRepository $userRepository;
    private EditNoteRepository $editNoteRepository;
    private NonActiveNoteRepository $nonActiveNoteRepository;

    public function __construct(
        UserRepository $userRepository,
        EditNoteRepository $editNoteRepository,
        NonActiveNoteRepository $nonActiveNoteRepository,
    ) {
        $this->userRepository          = $userRepository;
        $this->editNoteRepository      = $editNoteRepository;
        $this->nonActiveNoteRepository = $nonActiveNoteRepository;
    }

    public function editNote(LatestNote $latestNote): void
    {
        $user = $this->userRepository->userBySessionId();

        $this->editNoteRepository->editNote($latestNote, $user);
        $nonActiveNoteList = $this->nonActiveNoteRepository->noteList();

        if ($nonActiveNoteList->shouldDeleteEarliestNote()) {
            $this->nonActiveNoteRepository->deleteEarliestNote($nonActiveNoteList);
        }
    }

    public function editNoteTitle(LatestNoteBrief $latestNoteBrief): void
    {
        $user = $this->userRepository->userBySessionId();

        $this->editNoteRepository->editNoteTitle($latestNoteBrief, $user);
        $nonActiveNoteList = $this->nonActiveNoteRepository->noteList();

        if ($nonActiveNoteList->shouldDeleteEarliestNote()) {
            $this->nonActiveNoteRepository->deleteEarliestNote($nonActiveNoteList);
        }
    }
}

<?php

namespace Packages\Service\Note\Command;

use Packages\Domain\Note\Entities\InitNote;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Infrastructure\Repositories\Note\RegisterNoteRepository;
use Packages\Infrastructure\Repositories\User\UserRepository;

final class RegisterNoteService
{
    private UserRepository $userRepository;
    private RegisterNoteRepository $registerNoteRepository;

    public function __construct(
        UserRepository $userRepository,
        RegisterNoteRepository $registerNoteRepository,
    ) {
        $this->userRepository         = $userRepository;
        $this->registerNoteRepository = $registerNoteRepository;
    }

    public function registerNote(InitNote $initNote): NoteId
    {
        $user = $this->userRepository->userBySessionId();

        return $this->registerNoteRepository->registerNote($initNote, $user);
    }
}

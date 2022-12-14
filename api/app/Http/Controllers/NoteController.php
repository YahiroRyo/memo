<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\EditNoteRequest;
use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Service\Note\Command\EditNoteService;
use Packages\Service\Note\Command\RegisterNoteService;

class NoteController extends Controller
{
    private RegisterNoteService $registerNoteService;
    private EditNoteService $editNoteService;

    public function __construct(
        RegisterNoteService $registerNoteService,
        EditNoteService $editNoteService
    ) {
        $this->registerNoteService = $registerNoteService;
        $this->editNoteService     = $editNoteService;
    }

    public function registerNote(RegisterNoteRequest $request): array
    {
        return $this->registerNoteService->registerNote($request->fromDomain())->ofJson();
    }

    public function editNote(EditNoteRequest $request): void
    {
        $this->editNoteService->editNote($request->fromDomain());
    }
}

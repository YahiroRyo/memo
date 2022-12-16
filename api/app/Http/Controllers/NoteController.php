<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\DeleteNoteRequest;
use App\Http\Requests\Note\EditNoteRequest;
use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Service\Note\Command\DeleteNoteService;
use Packages\Service\Note\Command\EditNoteService;
use Packages\Service\Note\Command\RegisterNoteService;

class NoteController extends Controller
{
    private RegisterNoteService $registerNoteService;
    private EditNoteService $editNoteService;
    private DeleteNoteService $deleteNoteService;

    public function __construct(
        RegisterNoteService $registerNoteService,
        EditNoteService $editNoteService,
        DeleteNoteService $deleteNoteService
    ) {
        $this->registerNoteService = $registerNoteService;
        $this->editNoteService     = $editNoteService;
        $this->deleteNoteService   = $deleteNoteService;
    }

    public function registerNote(RegisterNoteRequest $request): array
    {
        return $this->registerNoteService->registerNote($request->fromDomain())->ofJson();
    }

    public function editNote(EditNoteRequest $request): void
    {
        $this->editNoteService->editNote($request->fromDomain());
    }

    public function deleteNote(DeleteNoteRequest $request): void
    {
        $this->deleteNoteService->deleteNote($request->fromDomain());
    }
}

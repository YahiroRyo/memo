<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\DeleteNoteRequest;
use App\Http\Requests\Note\EditNoteRequest;
use App\Http\Requests\Note\EditNoteTitleRequest;
use App\Http\Requests\Note\NoteListRequest;
use App\Http\Requests\Note\NoteRequest;
use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Service\Note\Command\DeleteNoteService;
use Packages\Service\Note\Command\EditNoteService;
use Packages\Service\Note\Command\RegisterNoteService;
use Packages\Service\Note\Query\ActiveNoteService;

class NoteController extends Controller
{
    private RegisterNoteService $registerNoteService;
    private EditNoteService $editNoteService;
    private DeleteNoteService $deleteNoteService;
    private ActiveNoteService $activeNoteService;

    public function __construct(
        RegisterNoteService $registerNoteService,
        EditNoteService $editNoteService,
        DeleteNoteService $deleteNoteService,
        ActiveNoteService $activeNoteService
    ) {
        $this->registerNoteService = $registerNoteService;
        $this->editNoteService     = $editNoteService;
        $this->deleteNoteService   = $deleteNoteService;
        $this->activeNoteService   = $activeNoteService;
    }

    public function registerNote(RegisterNoteRequest $request): array
    {
        return $this->registerNoteService->registerNote($request->fromDomain())->ofJson();
    }

    public function editNote(EditNoteRequest $request): void
    {
        $this->editNoteService->editNote($request->fromDomain());
    }

    public function editNoteTitle(EditNoteTitleRequest $request): void
    {
        $this->editNoteService->editNoteTitle($request->fromDomain());
    }

    public function deleteNote(DeleteNoteRequest $request): void
    {
        $this->deleteNoteService->deleteNote($request->fromDomain());
    }

    public function noteList(NoteListRequest $request): array
    {
        return $this->activeNoteService->searchNoteList($request->fromDomain())->ofJson();
    }

    public function note(NoteRequest $request): array
    {
        return $this->activeNoteService->note($request->fromDomain())->ofJson();
    }
}

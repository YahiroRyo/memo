<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Service\Note\Command\RegisterNoteService;

class NoteController extends Controller
{
    private RegisterNoteService $registerNoteService;

    public function __construct(RegisterNoteService $registerNoteService)
    {
        $this->registerNoteService = $registerNoteService;
    }

    public function registerNote(RegisterNoteRequest $request): array {
        return $this->registerNoteService->registerNote($request->ofDomain())->ofJson();
    }
}

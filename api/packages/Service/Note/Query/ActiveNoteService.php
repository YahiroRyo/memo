<?php

namespace Packages\Service\Note\Query;

use Packages\Domain\Note\Entities\Note;
use Packages\Domain\Note\Entities\SearchedNoteBriefList;
use Packages\Domain\Note\Entities\SearchNoteBriefList;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Infrastructure\Repositories\Note\ActiveNoteRepository;

final class ActiveNoteService
{
    private ActiveNoteRepository $activeNoteRepository;

    public function __construct(ActiveNoteRepository $activeNoteRepository)
    {
        $this->activeNoteRepository = $activeNoteRepository;
    }

    public function searchNoteList(SearchNoteBriefList $searchNoteBriefList): SearchedNoteBriefList
    {
        return $this->activeNoteRepository->searchNoteList($searchNoteBriefList);
    }

    public function note(NoteId $noteId): Note
    {
        return $this->activeNoteRepository->note($noteId);
    }
}

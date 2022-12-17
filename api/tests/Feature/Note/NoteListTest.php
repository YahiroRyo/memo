<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\NoteListRequest;
use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Domain\Note\Entities\SearchNoteBriefList;
use Packages\Domain\Note\ValueObjects\SearchKeyword;
use Packages\Domain\Note\ValueObjects\SearchNoteCount;

class NoteListTest extends NoteTestCase
{
    public function test_ノートの一覧取得を行えること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $response = $this->get('/api/notes');
        $response->assertOk();
        $response->assertJson(
            $this->activeNoteService->searchNoteList(
                new SearchNoteBriefList(
                    SearchKeyword::elseDefaultEmptyString(null),
                    SearchNoteCount::elseDefaultZero(null)
                )
            )->ofJson()
        );
    }

    public function test_ノートの一覧取得で検索を行えること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $noteListRequest = new NoteListRequest([
            'keyword' => $registerNoteRequest->title,
        ]);
        $response = $this->get('/api/notes' . $noteListRequest->fromParams());
        $response->assertOk();
        $response->assertJson(
            $this->activeNoteService->searchNoteList($noteListRequest->fromDomain())->ofJson()
        );
    }

    public function test_ノートの一覧取得で検索結果が0件であること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $noteListRequest = new NoteListRequest([
            'keyword' => 'HELLO WORLD',
        ]);
        $response = $this->get('/api/notes' . $noteListRequest->fromParams());
        $response->assertOk();
        $response->assertJsonCount(0);
    }
}

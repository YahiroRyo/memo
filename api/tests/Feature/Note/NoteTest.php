<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Domain\Note\ValueObjects\NoteId;

class NoteTest extends NoteTestCase
{
    public function test_ノートの詳細取得を行えること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $response = $this->get('/api/notes/' . $response->json('noteId'));
        $response->assertOk();
        $response->assertJson($this->activeNoteService->note(NoteId::from($response->json('noteId')))->ofJson());
    }

    public function test_ノートの詳細が存在しないこと(): void
    {
        $response = $this->get('/api/notes/' . 'aaaaaaaaaaaaaaaaaaaaaaaaaa');
        $response->assertNotFound();
    }
}

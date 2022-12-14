<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Infrastructure\Eloquents\Note\Note;

class RegisterNoteTest extends NoteTestCase
{
    public function test_ノート作成を行えること(): void
    {
        $registerNoteRequest = new RegisterNoteRequest([
            'title' => 'タイトル',
            'body'  => 'ボディ',
        ]);
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();
        $response->assertJson(NoteId::from(Note::first()->note_id)->ofJson());
    }
}

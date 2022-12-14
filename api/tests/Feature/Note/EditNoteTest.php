<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\EditNoteRequest;
use App\Http\Requests\Note\RegisterNoteRequest;

class EditNoteTest extends NoteTestCase
{
    public function test_ノート編集を行えること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $registerNoteRequest = new EditNoteRequest([
            'noteId' => $response->json('noteId'),
            'title'  => 'ﾃｽﾄ',
            'body'   => 'aaaa',
        ]);
        $response = $this->put('/api/notes', $registerNoteRequest->all());
        $response->assertOk();
    }
}

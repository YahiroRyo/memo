<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\EditNoteTitleRequest;
use App\Http\Requests\Note\RegisterNoteRequest;

class EditNoteTitleTest extends NoteTestCase
{
    public function test_ノートタイトル編集を行えること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $registerNoteRequest = new EditNoteTitleRequest([
            'title'  => 'ﾃｽﾄ',
        ]);
        $response = $this->put("/api/notes/{$response->json('noteId')}/title", $registerNoteRequest->all());
        $response->assertOk();
    }
}

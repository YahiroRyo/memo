<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\DeleteNoteRequest;
use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Infrastructure\Eloquents\Note\NonActiveNote;

class DeleteNoteTest extends NoteTestCase
{
    public function test_ノート削除を行えること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $deleteNoteRequest = new DeleteNoteRequest([
            'noteId' => $response->json('noteId'),
        ]);
        $response = $this->delete('/api/notes', $deleteNoteRequest->all());
        $response->assertOk();

        $this->assertCount(1, NonActiveNote::all()->toArray());
    }
}

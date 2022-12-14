<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\EditNoteRequest;
use App\Http\Requests\Note\RegisterNoteRequest;
use Packages\Infrastructure\Eloquents\Note\NonActiveNote;

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

    public function test_ノート編集を8回以上行った場合non_active_notesテーブルに該当のnoteが8個であること(): void
    {
        $registerNoteRequest = RegisterNoteRequest::fromDefaultValue();
        $registerNoteResponse = $this->post('/api/notes', $registerNoteRequest->all());
        $registerNoteResponse->assertOk();

        for ($i = 0; $i < 10; $i++) {
            $registerNoteRequest = new EditNoteRequest([
                'noteId' => $registerNoteResponse->json('noteId'),
                'title'  => 'ﾃｽﾄ',
                'body'   => 'aaaa',
            ]);
            $response = $this->put('/api/notes', $registerNoteRequest->all());
            $response->assertOk();
        }

        $this->assertCount(8, NonActiveNote::all()->toArray());
    }
}

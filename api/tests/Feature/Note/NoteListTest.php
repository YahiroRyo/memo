<?php

namespace Tests\Feature\Note;

use App\Http\Requests\Note\NoteListRequest;
use App\Http\Requests\Note\RegisterNoteRequest;

class NoteListTest extends NoteTestCase
{
    public function test_ノートの一覧取得を行えること(): void
    {
        $registerNoteRequest = new RegisterNoteRequest([
            'title' => 'タイトル',
            'body'  => 'ボディ',
        ]);
        $response = $this->post('/api/notes', $registerNoteRequest->all());
        $response->assertOk();

        $response = $this->get('/api/notes');
        $response->assertOk();
        $response->assertJsonCount(1);
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
        $response->assertJsonCount(1);
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

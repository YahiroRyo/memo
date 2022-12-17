<?php

namespace Tests\Feature\Note;

use Packages\Infrastructure\Eloquents\User\User;
use Packages\Infrastructure\Repositories\Note\ActiveNoteRepository;
use Packages\Service\Note\Query\ActiveNoteService;
use Tests\Feature\BaseTestCase;

class NoteTestCase extends BaseTestCase
{
    protected ActiveNoteService $activeNoteService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->activeNoteService = new ActiveNoteService(
            new ActiveNoteRepository()
        );

        $user = User::create([
            'email'    => 'a@a.aa',
            'password' => 'password',
        ]);

        $this->actingAs($user);
    }
}

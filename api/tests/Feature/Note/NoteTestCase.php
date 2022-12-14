<?php

namespace Tests\Feature\Note;

use Packages\Infrastructure\Eloquents\User\User;
use Tests\Feature\BaseTestCase;

class NoteTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = User::create([
            'email'    => 'a@a.aa',
            'password' => 'password',
        ]);

        $this->actingAs($user);
    }
}

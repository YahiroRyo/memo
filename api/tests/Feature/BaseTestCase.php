<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BaseTestCase extends TestCase {
    use DatabaseTransactions;
}

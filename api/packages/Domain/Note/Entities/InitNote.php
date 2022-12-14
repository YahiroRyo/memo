<?php

namespace Packages\Domain\Note\Entities;

use Packages\Domain\Note\ValueObjects\Body;
use Packages\Domain\Note\ValueObjects\Title;

final class InitNote
{
    private Title $title;
    private Body $body;

    public function __construct(
        Title $title,
        Body $body,
    ) {
        $this->title = $title;
        $this->body  = $body;
    }

    public function title(): Title {
        return $this->title;
    }

    public function body(): Body {
        return $this->body;
    }
}

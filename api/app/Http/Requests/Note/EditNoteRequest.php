<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Error\Entities\Errors;
use Packages\Domain\Note\Entities\LatestNote;
use Packages\Domain\Note\ValueObjects\Body;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\Note\ValueObjects\Title;

class EditNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }

    public function fromDomain(): LatestNote
    {
        $latestNote = new LatestNote(
            NoteId::unsafetyFrom($this->noteId),
            Title::unsafetyFrom($this->title),
            $this->elseBodyDefaultEmptyValue()
        );

        $errors = new Errors([]);
        $errors = $errors->addIfError($latestNote->noteId());
        $errors = $errors->addIfError($latestNote->title());
        $errors = $errors->addIfError($latestNote->body());
        $errors->throwIf();

        return $latestNote;
    }

    private function elseBodyDefaultEmptyValue(): Body
    {
        return Body::unsafetyFrom($this->body ?? '');
    }
}

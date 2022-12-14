<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Error\Entities\Errors;
use Packages\Domain\Note\Entities\InitNote;
use Packages\Domain\Note\ValueObjects\Body;
use Packages\Domain\Note\ValueObjects\Title;

class RegisterNoteRequest extends FormRequest
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

    public function ofDomain(): InitNote
    {
        $initNote = new InitNote(
            Title::from($this->title),
            Body::from($this->body)
        );

        $errors = new Errors([]);
        $errors = $errors->addIfError($initNote->title());
        $errors = $errors->addIfError($initNote->body());
        $errors->throwIf();

        return $initNote;
    }
}

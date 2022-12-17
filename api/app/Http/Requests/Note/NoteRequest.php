<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Note\ValueObjects\NoteId;

class NoteRequest extends FormRequest
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

    public function fromDomain(): NoteId
    {
        return NoteId::from($this->noteId);
    }
}

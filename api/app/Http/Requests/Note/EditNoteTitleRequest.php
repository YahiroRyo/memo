<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Error\Entities\Errors;
use Packages\Domain\Note\Entities\LatestNote;
use Packages\Domain\Note\Entities\LatestNoteBrief;
use Packages\Domain\Note\ValueObjects\Body;
use Packages\Domain\Note\ValueObjects\NoteId;
use Packages\Domain\Note\ValueObjects\Title;

class EditNoteTitleRequest extends FormRequest
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

    public function fromDomain(): LatestNoteBrief
    {
        $latestNoteBrief = new LatestNoteBrief(
            NoteId::unsafetyFrom($this->noteId),
            Title::unsafetyFrom($this->title),
        );

        $errors = new Errors([]);
        $errors = $errors->addIfError($latestNoteBrief->noteId());
        $errors = $errors->addIfError($latestNoteBrief->title());
        $errors->throwIf();

        return $latestNoteBrief;
    }
}

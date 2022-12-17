<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Note\Entities\SearchNoteBriefList;
use Packages\Domain\Note\ValueObjects\SearchKeyword;
use Packages\Domain\Note\ValueObjects\SearchNoteCount;

class NoteListRequest extends FormRequest
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

    public function fromParams(): string
    {
        $result = '';
        foreach ($this->all() as $key => $value) {
            $result .= '&' . $key . '=' . $value;
        }
        return '?' . substr($result, 1);
    }

    public function fromDomain(): SearchNoteBriefList
    {
        return new SearchNoteBriefList(
            SearchKeyword::elseDefaultEmptyString($this->keyword),
            SearchNoteCount::elseDefaultZero($this->noteCount),
        );
    }
}

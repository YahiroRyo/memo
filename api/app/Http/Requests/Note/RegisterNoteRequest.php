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

    public function fromDomain(): InitNote
    {
        $initNote = new InitNote(
            Title::unsafetyFrom($this->title),
            $this->elseBodyDefaultEmptyValue()
        );

        $errors = new Errors([]);
        $errors = $errors->addIfError($initNote->title());
        $errors = $errors->addIfError($initNote->body());
        $errors->throwIf();

        return $initNote;
    }

    public static function fromDefaultValue(): RegisterNoteRequest
    {
        return new RegisterNoteRequest([
            'title' => 'タイトル',
            'body'  => 'ボディー'
        ]);
    }

    private function elseBodyDefaultEmptyValue(): Body
    {
        return Body::unsafetyFrom($this->body ?? '');
    }
}

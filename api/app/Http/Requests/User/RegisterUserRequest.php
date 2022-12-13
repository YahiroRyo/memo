<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Error\Entities\Errors;
use Packages\Domain\User\Entities\InitUser;
use Packages\Domain\User\ValueObjects\Email;
use Packages\Domain\User\ValueObjects\Password;

class RegisterUserRequest extends FormRequest
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

    public function ofDomain(): InitUser
    {
        $initUser = new InitUser(
            Email::from($this->email),
            Password::from($this->password)
        );

        $errors = new Errors([]);
        $errors = $errors->addIfError($initUser->email());
        $errors = $errors->addIfError($initUser->password());
        $errors->throwIf();

        return $initUser;
    }
}

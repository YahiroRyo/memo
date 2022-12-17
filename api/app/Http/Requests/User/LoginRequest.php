<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Error\Entities\Errors;
use Packages\Domain\User\Entities\UserForLogin;
use Packages\Domain\User\ValueObjects\Email;
use Packages\Domain\User\ValueObjects\Password;

class LoginRequest extends FormRequest
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

    public function fromDomain(): UserForLogin
    {
        $userForLogin = new UserForLogin(
            Email::unsafetyFrom($this->email),
            Password::unsafetyFrom($this->password)
        );

        $errors = new Errors([]);
        $errors = $errors->addIfError($userForLogin->email());
        $errors = $errors->addIfError($userForLogin->password());
        $errors->throwIf();

        return $userForLogin;
    }
}

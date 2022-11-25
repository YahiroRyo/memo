<?php

namespace Packages\Domain\Validator\Entities;

use Illuminate\Support\Facades\Validator as LaravelValidationFactory;

final class ValidationFactory extends LaravelValidationFactory
{
    /** @return Validator */
    public static function make(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        /** @var \Illuminate\Validation\Validator */
        $validator = parent::make($data, $rules, $messages, $customAttributes);

        return Validator::of($validator);
    }
}

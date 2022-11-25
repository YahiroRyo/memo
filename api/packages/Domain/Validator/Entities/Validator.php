<?php

namespace Packages\Domain\Validator\Entities;

use Illuminate\Validation\ValidationException;
use \Illuminate\Validation\Validator as LaravelValidator;
use Illuminate\Support\Facades\Validator as LaravelValidationFactory;
use Packages\Domain\Validator\ValueObjects\ErrorMode;

final class Validator extends LaravelValidator {
    private static ErrorMode $errorMode = ErrorMode::THROW;
    private static array $validateResultList = [];

    public function validate() {
        try {
            parent::validate();
        } catch (ValidationException $e) {
            self::$validateResultList = array_merge(self::$validateResultList, $e->errors());

            $this->throwIf();
        }
    }

    public static function throwIf() {
        if (self::$errorMode->isThrowErrors() && !empty(self::$validateResultList)) {
            $laravelValidator = LaravelValidationFactory::make([], []);

            foreach (self::$validateResultList as $key => $value) {
                $laravelValidator->errors()->add($key, $value);
            }

            throw new ValidationException($laravelValidator);
        }
    }

    public static function resetStack() {
        self::$validateResultList = [];
    }

    public static function setErrorMode(ErrorMode $errorMode) {
        self::$errorMode = $errorMode;
    }

    public static function afterIfErrorThrow(callable $callback) {
        Validator::setErrorMode(ErrorMode::STACK);
        $result = $callback();
        Validator::setErrorMode(ErrorMode::THROW);

        self::throwIf();

        return $result;
    }

    public static function of(LaravelValidator $laravelValidator): Validator {
        return new Validator(
            $laravelValidator->getTranslator(),
            $laravelValidator->getData(),
            $laravelValidator->getRules(),
            $laravelValidator->customMessages,
            $laravelValidator->customAttributes,
        );
    }
}

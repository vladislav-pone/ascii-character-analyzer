<?php

namespace App\Validators;

use App\Contracts\ValidatorInterface;
use App\Exceptions\IncorrectModeProvidedException;

class ModeValidator implements ValidatorInterface
{
    public const ERROR_CODE_INCORRECT_MODE = 4;
    /**
     * @throws IncorrectModeProvidedException
     */
    public function validate(mixed $validatable): void
    {
        if ($validatable === 0) {
            throw new IncorrectModeProvidedException(
                "One of the following flags must be provided:\n" .
                "-L, --include-letter\n" .
                "-P, --include-punctuation\n" .
                "-S, --include-symbol\n",
                self::ERROR_CODE_INCORRECT_MODE
            );
        }
    }
}

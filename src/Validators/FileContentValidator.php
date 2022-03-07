<?php

namespace App\Validators;

use App\Contracts\ValidatorInterface;
use App\Exceptions\IncorrectFileException;

class FileContentValidator implements ValidatorInterface
{
    public const ERROR_CODE = 2;

    public function validate(mixed $validatable): void
    {
        if (preg_match('/[^a-z0-9\"!#%&\'()*+,\-.\/:;<=>?@\[\]^_{}]/', $validatable)) {
            throw new IncorrectFileException(
                "File content must be lower case alphabet ASCII letters, punctuations and symbols only!\n",
                self::ERROR_CODE
            );
        }
    }
}

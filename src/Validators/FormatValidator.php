<?php

namespace App\Validators;

use App\Contracts\ValidatorInterface;
use App\Exceptions\IncorrectFormatException;
use App\Services\GetCliArgumentsService;

class FormatValidator implements ValidatorInterface
{
    public const ERROR_CODE = 3;
    /**
     * @throws IncorrectFormatException
     */
    public function validate(mixed $validatable): void
    {
        $validFormats = array_keys(GetCliArgumentsService::VALID_FORMATS);
        if (!in_array($validatable, $validFormats)) {
            throw new IncorrectFormatException(
                sprintf(
                    "Format $validatable is not correct.\nAccepted values are: %s\n",
                    implode(', ', $validFormats)
                ),
                self::ERROR_CODE
            );
        }
    }
}

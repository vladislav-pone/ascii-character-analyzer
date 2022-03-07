<?php

namespace App\Validators;

use App\Contracts\ValidatorInterface;
use App\Exceptions\FileDoesNotExistsException;

class FileExistenceValidator implements ValidatorInterface
{
    public const ERROR_CODE = 1;
    /**
     * @throws FileDoesNotExistsException
     */
    public function validate(mixed $validatable): void
    {
        if (!is_file($validatable)) {
            throw new FileDoesNotExistsException(
                "File $validatable not found\n",
                self::ERROR_CODE
            );
        }
    }
}

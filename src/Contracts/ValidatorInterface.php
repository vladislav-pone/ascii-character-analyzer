<?php

namespace App\Contracts;

interface ValidatorInterface
{
    public function validate(mixed $validatable): void;
}

<?php

namespace App\Dto;

class CliArgumentsDto
{
    public function __construct(private string $fileContent, private int $format, private int $mode){}

    public function getFileContent(): string
    {
        return $this->fileContent;
    }

    public function getFormat(): int
    {
        return $this->format;
    }

    public function getMode(): int
    {
        return $this->mode;
    }
}

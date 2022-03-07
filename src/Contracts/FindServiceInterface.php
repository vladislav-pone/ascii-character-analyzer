<?php

namespace App\Contracts;

interface FindServiceInterface
{
    public const SERVICE_NON    = 0;
    public const SERVICE_LEAST  = 1;
    public const SERVICE_MOST   = 2;

    public static function getFormatName(): string;
    public function __invoke(string $content, int $mode): string;
}

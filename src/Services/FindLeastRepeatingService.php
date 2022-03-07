<?php

namespace App\Services;

class FindLeastRepeatingService extends AbstractFindService
{

    public static function getFormatName(): string
    {
        return "least repeating";
    }

    public function __invoke(string $content, int $mode): string
    {
        $characters = $this->countValidCharacters($content, $mode);
        return parent::find($characters, $content, 'min');
    }
}

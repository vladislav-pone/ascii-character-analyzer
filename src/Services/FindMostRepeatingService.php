<?php

namespace App\Services;

class FindMostRepeatingService extends AbstractFindService
{

    public static function getFormatName(): string
    {
        return "most repeating";
    }

    public function __invoke(string $content, int $mode): string
    {
        $characters = $this->countValidCharacters($content, $mode);
        return parent::find($characters, $content, 'max');
    }
}

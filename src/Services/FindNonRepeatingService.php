<?php

namespace App\Services;

class FindNonRepeatingService extends AbstractFindService
{

    public static function getFormatName(): string
    {
        return "non-repeating";
    }

    public function __invoke(string $content, int $mode): string
    {
        $characters = $this->countValidCharacters($content, $mode);
        return parent::find($characters, $content, static function(array $array) {
            return 1;
        });
    }
}

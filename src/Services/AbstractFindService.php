<?php

namespace App\Services;

use App\Contracts\FindServiceInterface;

abstract class AbstractFindService implements FindServiceInterface
{

    public const EMPTY_OUTPUT = "None";

    protected function getRegExpByMode(int $mode): string
    {
        if ($mode === GetCliArgumentsService::MODE_INCLUDE_LETTER) {
            return '/[a-z0-9]/';
        }
        if ($mode === GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION) {
            return '/[!,.?\-:]/';
        }
        return '/[\"#%&\'()*+\/;<=>@\[\]^_{}]/';
    }

    protected function countValidCharacters(string $content, int $mode): array
    {
        $matches = [];
        preg_match_all($this->getRegExpByMode($mode), $content, $matches);
        return array_count_values($matches[0]);
    }

    protected function find(array $characters, string $content, callable $function): string
    {
        if (empty($characters)) {
            return self::EMPTY_OUTPUT; // No content to check
        }

        $possibleCharacters = array_keys($characters, $function($characters));
        if (empty($possibleCharacters)) {
            return self::EMPTY_OUTPUT; // No selected mode characters match requested format
        }

        $regExp = sprintf('/[%s]/', implode('', $possibleCharacters));
        $matches = [];
        preg_match($regExp, $content, $matches, PREG_OFFSET_CAPTURE);
        return $matches[0][0];
    }
}

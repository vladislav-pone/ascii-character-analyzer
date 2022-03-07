<?php

namespace App\Services;

use App\Dto\CliArgumentsDto;
use App\Factories\FindServiceFactory;
use App\Kernel;
use DI\NotFoundException;

class CharacterFinderService
{
    public function __construct(private FindServiceFactory $factory) {}

    /**
     * @throws NotFoundException
     */
    public function handle(CliArgumentsDto $arguments): void
    {
        $findService = $this->factory->create($arguments->getFormat());
        if ($arguments->getMode() & GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION) {
            $character = $findService($arguments->getFileContent(), GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION);
            Kernel::output("First {$findService::getFormatName()} punctuation: $character");
        }
        if ($arguments->getMode() & GetCliArgumentsService::MODE_INCLUDE_SYMBOL) {
            $character = $findService($arguments->getFileContent(), GetCliArgumentsService::MODE_INCLUDE_SYMBOL);
            Kernel::output("First {$findService::getFormatName()} symbol: $character");
        }
        if ($arguments->getMode() & GetCliArgumentsService::MODE_INCLUDE_LETTER) {
            $character = $findService($arguments->getFileContent(), GetCliArgumentsService::MODE_INCLUDE_LETTER);
            Kernel::output("First {$findService::getFormatName()} letter: $character");
        }
    }
}

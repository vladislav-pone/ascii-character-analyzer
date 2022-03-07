<?php

namespace App;

use App\Services\CharacterFinderService;
use App\Services\GetCliArgumentsService;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use InvalidArgumentException;

final class Kernel
{
    private static self         $kernel;
    private static Container    $container;
    private static bool         $allowOutput = false;
    private function __construct() {}

    public static function getKernel(): self
    {
        if (!isset(self::$kernel)) {
            self::$kernel = new self();
        }
        return self::$kernel;
    }

    public static function getContainer(): Container
    {
        if (!isset(self::$container)) {
            self::$container = new Container();
        }
        return self::$container;
    }

    public static function output(string $output): void
    {
        if (self::$allowOutput) {
            echo "$output\n";
        }
    }

    public function handle(): int
    {
        self::$allowOutput = true; // Allow output to console when it is not a phpunit test
        try {
            $getCliArgumentsService = self::getContainer()->get(GetCliArgumentsService::class);
            $arguments = $getCliArgumentsService->getArguments();
            $characterFinder = self::getContainer()->get(CharacterFinderService::class);
            $characterFinder->handle($arguments);
        } catch (InvalidArgumentException|NotFoundException|DependencyException $e) {
            self::output($e->getMessage());
            return $e->getCode();
        }
        return 0;
    }
}

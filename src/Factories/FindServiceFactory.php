<?php

namespace App\Factories;

use App\Contracts\FindServiceInterface;
use App\Services\FindLeastRepeatingService;
use App\Services\FindMostRepeatingService;
use App\Services\FindNonRepeatingService;
use DI\NotFoundException;

class FindServiceFactory
{
    public const MAPPING = [
        FindServiceInterface::SERVICE_NON => FindNonRepeatingService::class,
        FindServiceInterface::SERVICE_LEAST => FindLeastRepeatingService::class,
        FindServiceInterface::SERVICE_MOST => FindMostRepeatingService::class,
    ];

    /**
     * @param int $service @see FindServiceFactory::MAPPING
     * @throws NotFoundException
     */
    public function create(int $service): FindServiceInterface
    {
        if (!array_key_exists($service, self::MAPPING)) {
            throw new NotFoundException("FindService Factory failed to find mapping for $service");
        }
        return new (self::MAPPING[$service]);
    }
}

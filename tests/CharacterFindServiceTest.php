<?php

use App\Contracts\FindServiceInterface;
use App\Dto\CliArgumentsDto;
use App\Factories\FindServiceFactory;
use App\Services\CharacterFinderService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class CharacterFindServiceTest extends TestCase
{

    protected function getFormattedArgumentsDto(int $format): Stub|CliArgumentsDto
    {
        $stub = $this->createStub(CliArgumentsDto::class);
        $stub->method('getFormat')->willReturn($format);
        return $stub;
    }

    protected function getFactoryMock(int $service): MockObject|FindServiceFactory
    {
        // FindServiceFactory::create($arguments->getFormat());
        $mock = $this->createMock(FindServiceFactory::class);
        $mock->expects($this->once())
            ->method('create')
            ->with($service);
        return $mock;
    }

    public function testFindServiceCanBuildNonRepeatingService()
    {
        $dto = $this->getFormattedArgumentsDto(FindServiceInterface::SERVICE_NON);
        $mock = $this->getFactoryMock(FindServiceInterface::SERVICE_NON);
        $service = new CharacterFinderService($mock);
        $service->handle($dto);
    }

    public function testFindServiceCanBuildLeastRepeatingService()
    {
        $dto = $this->getFormattedArgumentsDto(FindServiceInterface::SERVICE_LEAST);
        $mock = $this->getFactoryMock(FindServiceInterface::SERVICE_LEAST);
        $service = new CharacterFinderService($mock);
        $service->handle($dto);
    }

    public function testFindServiceCanBuildMostRepeatingService()
    {
        $dto = $this->getFormattedArgumentsDto(FindServiceInterface::SERVICE_MOST);
        $mock = $this->getFactoryMock(FindServiceInterface::SERVICE_MOST);
        $service = new CharacterFinderService($mock);
        $service->handle($dto);
    }
}

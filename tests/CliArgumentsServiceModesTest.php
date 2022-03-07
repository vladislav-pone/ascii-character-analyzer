<?php

use App\Dto\CliArgumentsDto;
use App\Exceptions\IncorrectModeProvidedException;
use App\Services\GetCliArgumentsService;

class CliArgumentsServiceModesTest extends AbstractCliArgumentsServiceTest
{
    public function testFailOnMissingModeFlags()
    {
        $this->expectException(IncorrectModeProvidedException::class);
        $this->getService()->unsetFlag('S')->unsetFlag('P')->unsetFlag('L')->getArguments();
    }

    public function testAcceptsLFlag()
    {
        $dto = $this->getService()->unsetFlag('S')->unsetFlag('P')->getArguments();
        $this->assertInstanceOf(CliArgumentsDto::class, $dto);
        $this->assertGreaterThan(
            0,
            $dto->getMode() &
            GetCliArgumentsService::MODE_INCLUDE_LETTER
        );
    }

    public function testAcceptsPFlag()
    {
        $dto = $this->getService()->unsetFlag('S')->unsetFlag('L')->getArguments();
        $this->assertInstanceOf(CliArgumentsDto::class, $dto);
        $this->assertGreaterThan(
            0,
            $dto->getMode() &
            GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION
        );
    }

    public function testAcceptsSFlag()
    {
        $dto = $this->getService()->unsetFlag('L')->unsetFlag('P')->getArguments();
        $this->assertInstanceOf(CliArgumentsDto::class, $dto);
        $this->assertGreaterThan(
            0,
            $dto->getMode() &
            GetCliArgumentsService::MODE_INCLUDE_SYMBOL
        );
    }

    public function testAcceptsAllFlags()
    {
        $dto = $this->getService()->getArguments();
        $this->assertInstanceOf(CliArgumentsDto::class, $dto);
        $this->assertSame(
            GetCliArgumentsService::MODE_INCLUDE_LETTER &
            GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION &
            GetCliArgumentsService::MODE_INCLUDE_SYMBOL,
            $dto->getMode() &
            GetCliArgumentsService::MODE_INCLUDE_LETTER &
            GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION &
            GetCliArgumentsService::MODE_INCLUDE_SYMBOL
        );
    }
}

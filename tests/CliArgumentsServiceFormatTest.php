<?php

use App\Dto\CliArgumentsDto;
use App\Exceptions\IncorrectFormatException;
use App\Services\GetCliArgumentsService;

class CliArgumentsServiceFormatTest extends AbstractCliArgumentsServiceTest
{
    public function testFailOnFormatFlagMissing()
    {
        $this->expectException(IncorrectFormatException::class);
        $this->getService()->unsetFlag('f')->getArguments();
    }

    public function testFailOnNonAcceptedFormat()
    {
        $this->expectException(IncorrectFormatException::class);
        $dto = $this->getService()->editFlag('f', 'wrong')->getArguments();
    }

    public function testMustAcceptNonRepeating()
    {
        $dto = $this->getService()->editFlag('f', 'non-repeating')->getArguments();
        $this->assertInstanceOf(CliArgumentsDto::class, $dto);
        $this->assertEquals(
            GetCliArgumentsService::VALID_FORMATS['non-repeating'],
            $dto->getFormat()
        );
    }

    public function testMustAcceptLeastRepeating()
    {
        $dto = $this->getService()->editFlag('f', 'least-repeating')->getArguments();
        $this->assertEquals(
            GetCliArgumentsService::VALID_FORMATS['least-repeating'],
            $dto->getFormat()
        );
    }

    public function testMustAcceptMostRepeating()
    {
        $dto = $this->getService()->editFlag('f', 'most-repeating')->getArguments();
        $this->assertEquals(
            GetCliArgumentsService::VALID_FORMATS['most-repeating'],
            $dto->getFormat()
        );
    }
}

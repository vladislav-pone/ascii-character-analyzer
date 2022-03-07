<?php

use App\Dto\CliArgumentsDto;
use App\Exceptions\FileDoesNotExistsException;
use App\Exceptions\IncorrectFileException;

class CliArgumentsServiceInputTest extends AbstractCliArgumentsServiceTest
{
    public function testFailOnInputFlagMissing()
    {
        $this->expectException(FileDoesNotExistsException::class);
        $this->getService()->unsetFlag('i')->getArguments();
    }

    public function testFailOnInputFlagFileNotExists()
    {
        $this->expectException(FileDoesNotExistsException::class);
        $this->getService()->editFlag('i', '/fake-file')->getArguments();
    }

    public function testFailOnInputFlagFileIsDirectory()
    {
        $this->expectException(FileDoesNotExistsException::class);
        $this->getService()->editFlag('i', '')->getArguments();
    }

    public function testInputFlagMustHaveFile()
    {
        $this->assertInstanceOf(CliArgumentsDto::class, $this->getService()->getArguments());
    }

    public function testInputFileDoesNotHaveWhitespace()
    {
        $this->expectException(IncorrectFileException::class);
        $this->getService()->editFlag('i', 'tests/Input/invalid-whitespace.txt')->getArguments();
    }
}

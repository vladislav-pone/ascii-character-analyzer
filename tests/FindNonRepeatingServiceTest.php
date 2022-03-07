<?php

use App\Services\FindNonRepeatingService;
use App\Services\GetCliArgumentsService;
use PHPUnit\Framework\TestCase;

class FindNonRepeatingServiceTest extends TestCase
{

    protected function getService(): FindNonRepeatingService
    {
        return new FindNonRepeatingService();
    }

    public function testWillReturnNoneLetters()
    {
        $service = $this->getService();
        $this->assertEquals('None', $service("!+", GetCliArgumentsService::MODE_INCLUDE_LETTER));
    }

    public function testWillReturnNonePunctuations()
    {
        $service = $this->getService();
        $this->assertEquals('None', $service("a+", GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION));
    }

    public function testWillReturnNoneSymbols()
    {
        $service = $this->getService();
        $this->assertEquals('None', $service("!a", GetCliArgumentsService::MODE_INCLUDE_SYMBOL));
    }

    public function testWillReturnLetters()
    {
        $service = $this->getService();
        $this->assertEquals('a', $service("bba!+", GetCliArgumentsService::MODE_INCLUDE_LETTER));
    }

    public function testWillReturnPunctuations()
    {
        $service = $this->getService();
        $this->assertEquals('!', $service(",,a!+", GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION));
    }

    public function testWillReturnSymbols()
    {
        $service = $this->getService();
        $this->assertEquals('+', $service("&&a!+", GetCliArgumentsService::MODE_INCLUDE_SYMBOL));
    }

    public function testWillReturnFirstLetters()
    {
        $service = $this->getService();
        $this->assertEquals('a', $service("bab!!+&", GetCliArgumentsService::MODE_INCLUDE_LETTER));
    }

    public function testWillReturnFirstPunctuations()
    {
        $service = $this->getService();
        $this->assertEquals(',', $service("aabb!,!+&", GetCliArgumentsService::MODE_INCLUDE_PUNCTUATION));
    }

    public function testWillReturnFirstSymbols()
    {
        $service = $this->getService();
        $this->assertEquals('+', $service("aabb!!+&", GetCliArgumentsService::MODE_INCLUDE_SYMBOL));
    }
}

<?php

use App\Kernel;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\GetCliArgumentsServiceMock;

abstract class AbstractCliArgumentsServiceTest extends TestCase
{
    protected function getService(): GetCliArgumentsServiceMock
    {
        return Kernel::getContainer()->get(GetCliArgumentsServiceMock::class)->setDefaultFlags();
    }
}

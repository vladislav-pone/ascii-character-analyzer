<?php

namespace Tests\Mocks;

use App\Services\GetCliArgumentsService;

final class GetCliArgumentsServiceMock extends GetCliArgumentsService
{
    public const DEFAULT_FLAGS = [
        "i" => 'tests/Input/valid.txt',
        "f" => "least-repeating",
        "P" => false,
        "L" => false,
        "S" => false,
    ];

    private array $flags = self::DEFAULT_FLAGS;

    protected function getRawArguments(): array
    {
        return $this->flags;
    }

    public function unsetFlag(string $flag): self
    {
        unset($this->flags[$flag]);

        return $this;
    }

    public function editFlag(string $flag, mixed $value): self
    {
        $this->flags[$flag] = $value;

        return $this;
    }

    public function setDefaultFlags(): self
    {
        $this->flags = self::DEFAULT_FLAGS;

        return $this;
    }
}

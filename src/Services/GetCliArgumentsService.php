<?php

namespace App\Services;

use App\Contracts\FindServiceInterface;
use App\Dto\CliArgumentsDto;
use App\Exceptions\FileDoesNotExistsException;
use App\Exceptions\IncorrectFormatException;
use App\Exceptions\IncorrectModeProvidedException;
use App\Kernel;
use App\Validators\FileContentValidator;
use App\Validators\FileExistenceValidator;
use App\Validators\FormatValidator;
use App\Validators\ModeValidator;

class GetCliArgumentsService
{
    public const VALID_FORMATS = [
        'non-repeating' => FindServiceInterface::SERVICE_NON,
        'least-repeating' => FindServiceInterface::SERVICE_LEAST,
        'most-repeating' => FindServiceInterface::SERVICE_MOST,
    ];

    public const MODE_INCLUDE_LETTER = 0b001; // Binary 1
    public const MODE_INCLUDE_PUNCTUATION = 0b010; // Binary 2
    public const MODE_INCLUDE_SYMBOL = 0b100; // Binary 4

    public function __construct(
        private FileExistenceValidator  $fileValidator,
        private FileContentValidator    $fileContentValidator,
        private FormatValidator         $formatValidator,
        private ModeValidator           $modeValidator,
    ) {}

    /**
     * @throws FileDoesNotExistsException
     * @throws IncorrectFormatException
     * @throws IncorrectModeProvidedException
     */
    public function getArguments(): CliArgumentsDto
    {
        $arguments = $this->getRawArguments();
        return $this->processArguments($arguments);
    }

    /**
     * @throws FileDoesNotExistsException
     * @throws IncorrectFormatException
     * @throws IncorrectModeProvidedException
     */
    protected function processArguments(array $arguments): CliArgumentsDto
    {
        $file = $arguments['i'] ?? $arguments['input'] ?? null;
        $filepath = dirname(__FILE__) . "/../../" . $file;
        $this->fileValidator->validate($filepath);
        Kernel::output("File: $file");

        $content = file_get_contents($filepath);
        $this->fileContentValidator->validate($content);

        $format = $arguments['f'] ?? $arguments['format'] ?? null;
        $this->formatValidator->validate($format);

        $mode = 0b000; // Binary 0
        if (key_exists('L', $arguments) || key_exists('include-letter', $arguments)) {
            $mode += self::MODE_INCLUDE_LETTER;
        }
        if (key_exists('S', $arguments) || key_exists('include-punctuation', $arguments)) {
            $mode += self::MODE_INCLUDE_SYMBOL;
        }
        if (key_exists('P', $arguments) || key_exists('include-symbol', $arguments)) {
            $mode += self::MODE_INCLUDE_PUNCTUATION;
        }
        $this->modeValidator->validate($mode);

        return new CliArgumentsDto($content, self::VALID_FORMATS[$format], $mode);
    }

    protected function getRawArguments(): array
    {
        $shortOptions = "i:"; // -i flag with required value
        $shortOptions .= "f:"; // -f flag with required value
        $shortOptions .= "L"; // -L flag
        $shortOptions .= "P"; // -P flag
        $shortOptions .= "S"; // -S flag

        $longOptions  = array(
            "input:", // --input flag with value
            "format:", // --format flag with value
            "include-letter", // --include-letter
            "include-punctuation", // --include-punctuation
            "include-symbol", // --include-symbol
        );
        return getopt($shortOptions, $longOptions);
    }
}

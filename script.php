<?php

// Add composer autoloader
require __DIR__ . '/vendor/autoload.php';

// handle script execution and return status code;
exit(\App\Kernel::getKernel()->handle());

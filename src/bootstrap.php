<?php

use React\EventLoop\Factory;
use Rx\Scheduler;

if (file_exists($file = __DIR__.'/../vendor/autoload.php')) {
    $autoload = require_once $file;
    $autoload->addPsr4('Vendor\\Rx\\Operator\\', __DIR__ . '/custom-operator');
} else {
    throw new RuntimeException('Install dependencies to run test suite.');
}

$loop = Factory::create();

Scheduler::setDefaultFactory(function () use ($loop) {
    return new Scheduler\EventLoopScheduler($loop);
});

register_shutdown_function(function () use ($loop) {
    $loop->run();
});

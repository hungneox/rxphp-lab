<?php

require_once __DIR__ . '/../vendor/autoload.php';

$fruits = ['orange', 'banana', 'strawberry', 'rasberry'];

$loop = React\EventLoop\Factory::create();

//You only need to set the default scheduler once
Rx\Scheduler::setDefaultFactory(function() use($loop){
    return new Rx\Scheduler\EventLoopScheduler($loop);
});

$observer = new \Rx\Observer\CallbackObserver(
    function($value){
        printf("%s\n", $value);
    },
    function (Exception $ex) {
        echo 'Error: ', $ex->getMessage(), PHP_EOL;
    },
    function(){
        printf("Complete\n");
    });

\Rx\Observable::fromArray($fruits)->map(function($value){
    return strlen($value);
})->subscribe($observer);


$loop->run();

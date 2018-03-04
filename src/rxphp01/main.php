<?php

require_once __DIR__ . '/../bootstrap.php';

$fruits = ['orange', 'banana', 'strawberry', 'rasberry'];

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

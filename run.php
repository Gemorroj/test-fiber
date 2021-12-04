<?php

require __DIR__.'/vendor/autoload.php';

use TestFiber\Runner;


$fiber1 = new \Fiber(function () {
    sleep(2);
    return 'Hello';
});
$fiber2 = new \Fiber(function () {
    sleep(1);
    return 'World';
});
$fiber3 = new \Fiber(function () {
    sleep(5);
    return '!';
});

$start = microtime(true);
$fiber1->start();
$fiber2->start();
$fiber3->start();

$create = microtime(true);

$runner = new Runner();
$data = $runner->wait([$fiber1, $fiber2, $fiber3]);
$wait = microtime(true);

print_r($data);
print_r([
    'start' => $create - $start,
    'wait' => $wait - $create,
]);

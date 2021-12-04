<?php

require __DIR__.'/vendor/autoload.php';


use TestFiber\Runner;


$runner = new Runner();

$start = microtime(true);
$fiber1 = $runner->create(function () {
    sleep(2);
   return 'Hello';
});
$fiber2 = $runner->create(function () {
    sleep(1);
    return 'World';
});
$fiber3 = $runner->create(function () {
    sleep(5);
    return '!';
});
$create = microtime(true);

$data = $runner->wait([$fiber1, $fiber2, $fiber3]);
$wait = microtime(true);


print_r($data);
print_r([
    'start' => $wait - $start,
    'create' => $wait - $create,
]);

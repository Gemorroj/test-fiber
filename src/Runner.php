<?php

declare(strict_types=1);

namespace TestFiber;

class Runner
{
    public function create(callable $function)
    {
        $fiber = new \Fiber($function);
        $fiber->start();
        return $fiber;
    }

    public function wait(iterable $fibers): array
    {
        $data = [];
        while($fibers) {
            foreach ($fibers as $key => $fiber) {
                if ($fiber->isRunning()) {
                    \usleep(1000);
                } else {
                    $data[$key] = $fiber->getReturn();
                    unset($fibers[$key]);
                }
            }
        }

        return $data;
    }
}

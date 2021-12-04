<?php

declare(strict_types=1);

namespace TestFiber;

class Runner
{
    public function wait(iterable $fibers): array
    {
        $data = [];
        while($fibers) {
            foreach ($fibers as $key => $fiber) {
                if ($fiber->isRunning()) {
                    \usleep(100);
                } else {
                    $data[$key] = $fiber->getReturn();
                    unset($fibers[$key]);
                }
            }
        }

        return $data;
    }
}

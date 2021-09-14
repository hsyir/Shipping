<?php

namespace Hsy\Shipping\Drivers;

class PostPishtaz extends Driver
{
    public function checkAvailability(): bool
    {
        return true;
    }

    public function calcCost(): int
    {
        $config = $this->configuration;
        dd($config);
    }
}

<?php

namespace Hsy\Shipping\Drivers;

class PostPishtaz extends Driver
{
    public function checkAvailability(): bool
    {
        return false;
    }

    public function calcCost(): int
    {
        return 5000;
    }
}

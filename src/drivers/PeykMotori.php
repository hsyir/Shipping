<?php

namespace Hsy\Shipping\Drivers;

class PeykMotori extends Driver
{
    public function checkAvailability(): bool
    {
        return true;
    }

    public function calcCost(): int
    {
        return 10000;
    }
}

<?php

namespace Hsy\Shipping\Driver;

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

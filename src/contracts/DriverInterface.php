<?php

namespace Hsy\Shipping\Contracts;

interface DriverInterface
{
    public function checkAvailability();
    public function calcCost();

    /**
     * @return Integer
     */
    public function getCost(): int;

    /**
     * @return boolean
     */
    public function isAvailable(): bool;
}

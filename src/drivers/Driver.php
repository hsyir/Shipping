<?php

namespace Hsy\Shipping\Drivers;

use Hsy\Shipping\Contracts\CartInterface;
use Hsy\Shipping\Contracts\DriverInterface;

abstract class Driver implements DriverInterface
{
    protected $from;
    protected $to;
    protected $cart;
    protected $configuration;

    protected $cost;
    protected $available = false;

    public function __construct(CartInterface $cart, $from, $to, $configuration)
    {
        $this->cart = $cart;
        $this->from = $from;
        $this->to = $to;
        $this->configuration = $configuration;

        $this->available = $this->checkAvailability();
        if ($this->isAvailable())
            $this->cost = $this->calcCost();
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function isAvailable(): bool
    {
        return (bool)$this->available;
    }

}

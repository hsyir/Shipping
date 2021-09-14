<?php

namespace Hsy\Shipping\Driver;

use Hsy\Shipping\Contracts\CartInterface;
use Hsy\Shipping\Contracts\DriverInterface;

abstract class Driver implements DriverInterface
{
    protected $from;
    protected $to;
    protected $cart;
    protected $configuration;

    public $cost;
    public $available;

    public function __construct(CartInterface $cart, $from, $to, $configuration)
    {
        $this->cart = $cart;
        $this->from = $from;
        $this->to = $to;
        $this->configuration = $configuration;

        $this->checkAvailability();
        $this->calcCost();
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

}

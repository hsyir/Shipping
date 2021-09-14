<?php

namespace Hsy\Shipping;

use Hsy\Shipping\Driver\PeykMotori;
use Hsy\Shipping\Driver\PostPishtaz;

class ShippingSystem
{

    private $cart;
    private $from;
    private $to;

    /**
     * @var array
     */
    private $selectedDrivers;

    public function __construct($cart, $from, $to, $selectedDrivers = [])
    {
        $this->cart = $cart;
        $this->from = $from;
        $this->to = $to;
        $this->selectedDrivers = $selectedDrivers;
    }

    public function setSelectedDrivers(array $drivers)
    {
        $this->selectedDrivers = $drivers;
    }

    private function getNecessaryDrivers(): array
    {
        $drivers = [];
        foreach ($this->selectedDrivers as $driver) {
            $drivers[] = $this->makeDriverClass($driver);
        }

        return $drivers;
    }

    private function makeDriverClass($driver)
    {
        $class = config("shipping.map.", $driver["name"]);
        return new $class(
            $this->cart,
            $this->from,
            $this->to,
            $driver["configuration"]
        );
    }

    public function getShipment($onlyAvailableDrivers = true)
    {
        $drivers = $this->getNecessaryDrivers();

        if ($onlyAvailableDrivers) {
            $drivers->reject(function ($driver) {
                return $driver["available"] == false;
            });
        }

        return $drivers;
    }

}

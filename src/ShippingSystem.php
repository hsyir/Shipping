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
    private $userConfiguration;

    public function __construct($cart, $from, $to, $userConfiguration = [])
    {
        $this->cart = $cart;
        $this->from = $from;
        $this->to = $to;
        $this->userConfiguration = $userConfiguration;
    }

    private function getUserSelectedDrivers(): array
    {
        $drivers = [];
        foreach ($this->userConfiguration as $config) {
            $drivers[] = $this->makeDriverClass($config["driver"], $config["config"]);
        }

        return $drivers;
    }

    private function makeDriverClass($driver, $config)
    {
        $class = "Hsy\Shipping\Drivers\PeykMotori";
        return new $class(
            $this->cart,
            $this->from,
            $this->to,
            $config
        );
    }

    public function getShipment($onlyAvailableDrivers = true)
    {
        $drivers = $this->getUserSelectedDrivers();

        if ($onlyAvailableDrivers) {
            $drivers->reject(function ($driver) {
                return $driver["available"] == false;
            });
        }

        return $drivers;
    }

}

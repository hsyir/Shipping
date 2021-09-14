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

    private function getUserSelectedDrivers(): \Illuminate\Support\Collection
    {
        $drivers = [];
        foreach ($this->userConfiguration as $config) {
            $drivers[] = $this->makeDriverClass($config["driver"], $config["config"]);
        }

        return collect($drivers);
    }

    /**
     * @param $driver
     * @param $config
     * @return mixed
     */
    private function makeDriverClass($driver, $config)
    {
        $class = config("shipping.map." . $driver);
//        dd($class);
        return new $class(
            $this->cart,
            $this->from,
            $this->to,
            $config
        );
    }

    public function getShipment($onlyAvailableDrivers = true): \Illuminate\Support\Collection
    {
        $drivers = $this->getUserSelectedDrivers();

        $drivers = $drivers
            ->when($onlyAvailableDrivers, function ($drivers) {
                return $drivers->reject(function ($driver) {
                    return !$driver->isAvailable();
                });
            });

        return $drivers;
    }

}

<?php

namespace Hsy\Shipping;


class ShippingSystem
{
    private $cart;
    private $from;
    private $to;

    /**
     * @var array
     */
    private $userConfiguration;

    public function setCart($cart): ShippingSystem
    {
        $cartResolverClass = config("shipping.cart-resolver");
        $this->cart = new $cartResolverClass($cart);
        return $this;
    }

    public function setTo($to): ShippingSystem
    {
        $this->to = $to;
        return $this;
    }

    public function setfrom($from): ShippingSystem
    {
        $this->from = $from;
        return $this;
    }

    public function setUserConfiguration($userConfiguration): ShippingSystem
    {
        $this->userConfiguration = $userConfiguration;
        return $this;
    }

    public function setData($cart, $from, $to, $userConfiguration): ShippingSystem
    {
        $this->setCart($cart);
        $this->setfrom($from);
        $this->setTo($to);
        $this->setUserConfiguration($userConfiguration);
        return $this;
    }

    public function __construct($cart, $from, $to, $userConfiguration = [])
    {
        $this->setData($cart, $from, $to, $userConfiguration);
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

        return $drivers
            ->when($onlyAvailableDrivers, function ($drivers) {
                return $drivers->reject(function ($driver) {
                    return !$driver->isAvailable();
                });
            });
    }

}

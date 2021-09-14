<?php

namespace Hsy\Shipping\Tests;


use Hsy\Shipping\ShippingSystem;

class ShippingTest extends TestCase
{
    public function test()
    {
        $cart = [
            [
                "weight" => "2.5",
                "out_of_size" => false,
            ],
            [
                "weight" => "0.6",
                "out_of_size" => true,
            ]
        ];
        $cart = new CartResolver($cart);

        $from=10;
        $to=10;

        $shipping = new ShippingSystem($cart, $from, $to);
        $shipping->selectDrivers(["PeykMotori" => ["title" => "پیک موتوری"]]);
        $shipping->getShipment();
    }
}
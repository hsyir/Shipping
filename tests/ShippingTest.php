<?php

namespace Hsy\Shipping\Tests;


use Hsy\Shipping\ResolveCart;
use Hsy\Shipping\ShippingSystem;

class ShippingTest extends TestCase
{
    public function test()
    {
        $userConfiguration = [
            [
                "driver" => "peyk-motori",
                "title" => "پیک موتوری",
                "config" => [
                    "prices" => [
                        "3" => 1500,
                        "10" => 6500,
                    ],
                    "availability" => [

                    ]
                ]
            ],
            [
                "driver" => "post-pishtaz",
                "title" => "پست پیشتاز",
                "config" => [
                    "prices" => [
                        "1" => [
                            "inside" => 1000,
                            "aside" => 2000,
                            "outside" => 3000,
                        ]
                    ],
                    "availability" => [

                    ]
                ]
            ]
        ];
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

        $from = 10;
        $to = 10;

        $shipping = new ShippingSystem($cart, $from, $to, $userConfiguration);
        $shipping = $shipping->getShipment();

        dd($shipping);

    }
}

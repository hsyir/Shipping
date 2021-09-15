<?php

return [
    "cart-resolver" => \Hsy\Shipping\ResolveCart::class,
    "drivers" => [

    ],
    "map" => [
        "peyk-motori" => \Hsy\Shipping\Drivers\PeykMotori::class,
        "post-pishtaz" => \Hsy\Shipping\Drivers\PostPishtaz::class,
    ]

];

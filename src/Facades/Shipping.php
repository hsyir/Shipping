<?php

namespace Hsy\Shipping\Facades;

use Hsy\Shipping\ShippingSystem;

class Shipping extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ShippingSystem::class;
    }
}

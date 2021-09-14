<?php

namespace Hsy\Shipping;

class ShippingServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/shipping.php', 'shipping');
    }

    public function boot()
    {

    }
}

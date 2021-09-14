<?php


namespace Hsy\Shipping;


use Hsy\Shipping\Contracts\CartInterface;
use Hsy\Shipping\Contracts\CartItemsInterface;

class ResolveCart implements CartInterface
{
    public function __construct($cart)
    {

    }

    public function setCart()
    {
        // TODO: Implement setCart() method.
    }

    public function weight(): float
    {
        // TODO: Implement weight() method.
    }

    public function hasOutOfSizeProduct(): bool
    {
        // TODO: Implement hasOutOfSizeProduct() method.
    }

    public function items(): CartItemsInterface
    {
        // TODO: Implement items() method.
    }
}
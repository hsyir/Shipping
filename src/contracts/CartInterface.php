<?php

namespace Hsy\Shipping\Contracts;

interface CartInterface
{

    public function __construct($cart);

    /**
     * @return void
     */
    public function setCart();

    /**
     * @return double
     */
    public function weight(): float;

    /**
     * @return boolean
     */
    public function hasOutOfSizeProduct(): bool;

    /**
     * @return CartItemsInterface
     */
    public function items(): CartItemsInterface;
}

<?php

class ShippingProduct
{
    private $product;
    private $count;

    public function __construct(product $product, int $count)
    {
        $this->product = $product;
        $this->count = $count;
    }

    public function getCount() : int
    {
        return $this->count;
    }

    public function getProduct() : product
    {
        return $this->product;
    }

    public function getTotal()
    {
        return $this->product->getPrijs() * $this->count;
    }
}
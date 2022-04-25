<?php

namespace App\Services;

use App\Models\{Product, Order};

class ProductStockManagerService
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function removeProductFromStock()
    {
        foreach ($this->order->orderProducts as $product) {
            Product::with('stock')->find($product->id)->stock->decrement('quantity_in_stock', $product->pivot->quantity);
        }
    }

    public function addingProductInStock()
    {
        foreach ($this->order->orderProducts as $product) {
            Product::with('stock')->find($product->id)->stock->increment('quantity_in_stock', $product->pivot->quantity);
        }
    }
}
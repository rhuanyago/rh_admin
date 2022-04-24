<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->belongsToMany(Order::class, Order::RELATIONSHIP_ORDER_PRODUCTS, 'order_id', 'product_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function stock()
    {
        return $this->hasOne(StockProduct::class, 'product_id', 'id');
    }
}

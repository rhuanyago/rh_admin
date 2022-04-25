<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const RELATIONSHIP_ORDER_PRODUCTS = 'order_products';
    const RELATIONSHIP_ORDER_PAYMENTS = 'order_payments';

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function clientMany()
    {
        return $this->belongsToMany(Client::class);
    }

    public function orderProducts()
    {
        return $this->belongsToMany(Product::class, self::RELATIONSHIP_ORDER_PRODUCTS, 'order_id', 'product_id')->withPivot(['quantity']);
    }

    public function orderPayments()
    {
        return $this->belongsToMany(PaymentMethod::class, self::RELATIONSHIP_ORDER_PAYMENTS, 'order_id', 'payment_id');
    }

    public function getPurchaseDateAttribute($value)
    {
        return date('d/m/Y H:i:s', strtotime($value));
    }
}

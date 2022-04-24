<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaymentMethod extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->belongsToMany(Order::class, Order::RELATIONSHIP_ORDER_PAYMENTS, 'order_id', 'payment_id');
    }
}

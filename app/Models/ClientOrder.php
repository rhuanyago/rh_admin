<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientOrder extends Model
{
    use HasFactory;

    protected $table = "client_orders";

    protected $fillable = ['client_id', 'order_id'];

    public $timestamps = false;
}

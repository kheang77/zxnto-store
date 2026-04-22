<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_orders';
    protected $fillable = [
        'order_number', 'customer_name', 'customer_email',
        'customer_phone', 'customer_address', 'payment_method',
        'items', 'total', 'status', 'note',
    ];
    protected $casts = ['items' => 'array'];
}

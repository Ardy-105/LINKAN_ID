<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'buyer_name', 'buyer_email', 'qty', 'total_price', 'status'
    ];

    public function product()
    {
        return $this->belongsTo(DigitalProduct::class);
    }
}


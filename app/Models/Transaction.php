<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'buyer_name', 'buyer_email', 'qty', 'total_price', 'status'
    ];

    protected $with = ['product']; // Eager load product relationship

    public function product()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
    }

    // Helper method untuk mendapatkan status yang valid
    public static function getValidStatuses()
    {
        return ['success', 'pending', 'failed'];
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalProduct extends Model
{
    protected $table = 'digital_products';

    protected $fillable = [
        'user_id',
        'image',
        'title',
        'description',
        'platform_type',
        'platform_url',
        'platform_file',
        'price',
        'sale_price',
        'has_quantity_limit',
        'quantity',
        'button_text',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';

    protected $fillable = [
        'name',
        'preview_image',
        'background_image',
    ];

    public $timestamps = true;
} 
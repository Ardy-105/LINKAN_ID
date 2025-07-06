<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlink extends Model
{
    protected $fillable = ['slug', 'destination', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

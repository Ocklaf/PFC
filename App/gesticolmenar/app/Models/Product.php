<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function beehive()
    {
        return $this->belongsTo(Beehive::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

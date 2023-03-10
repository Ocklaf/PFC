<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beehive extends Model
{
    use HasFactory;

    public function apiary()
    {
        return $this->belongsTo(Apiary::class);
    }

    public function queen()
    {
        return $this->hasOne(Queen::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

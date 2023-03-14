<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public function apiary()
    {
        return $this->hasOne(Apiary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
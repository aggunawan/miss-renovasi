<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'confirmed_at' => 'datetime'
    ];

    protected $fillable = [
        'user_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';

    protected $fillable = [
        'uid',
        'pid',
        'name',
        'price',
        'qty',
        'image',
        'total',
    ];

    public $timestamps = false;
}

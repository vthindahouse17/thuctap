<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice_order';

    protected $fillable = [
        'uid',
        'created_at',
        'name',
        'address',
        'phone',
        'email',
        'note',
        'status',
    ];

    public $timestamps = false;
}

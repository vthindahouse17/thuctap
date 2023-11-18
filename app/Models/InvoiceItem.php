<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'invoice_order_item';

    protected $fillable = [
        'order_id',
        'pid',
        'qty',
        'price',
        'total',
        'name',
    ];

    public $timestamps = false;
}

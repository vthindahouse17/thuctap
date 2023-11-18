<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;

    public $table = "banners";

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_link',
        'image',
        'status',
    ];
    
}

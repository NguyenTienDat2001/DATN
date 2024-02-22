<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category',
        'buy_price',
        'sell_price',
        'author',
        'age',
        'published_at',
        'publisher',
        'count',
        'totalsale',
        'img',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'des',
        'type',
        'value',
        'point',
        'condition',
        'status',
        'start_date',
        'end_date',
    ];
}

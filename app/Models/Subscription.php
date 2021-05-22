<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subtotal',
        'tax',
        'total',
        'payment_details',
        'valid_till',
        'status',
        'transaction_id',
        'currency'
    ];
}

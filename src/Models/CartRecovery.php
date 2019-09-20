<?php

namespace timramseyjr\CartRecovery\Models;

use Illuminate\Database\Eloquent\Model;

class CartRecovery extends Model
{
    protected $table = 'cart_recovery_data';
    protected $fillable = [
        'email',
        'cart',
        'name',
        'user_info',
        'normal',
        'recovered',
        'complete',
        'email_count'
    ];
}

<?php

namespace timramseyjr\CartRecovery\Models;

use Illuminate\Database\Eloquent\Model;

class CartRecoveryEmail extends Model
{
    protected $table = 'cart_recovery_email';
    protected $fillable = [
        'email',
        'recovery_id',
        'email_number'
    ];
}

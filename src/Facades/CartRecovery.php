<?php

namespace timramseyjr\CartRecovery\Facades;

use Illuminate\Support\Facades\Facade;

class CartRecovery extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart-recovery';
    }
}

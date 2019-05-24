<?php

namespace timramseyjr\CartRecovery\Listeners;

use Illuminate\Support\Facades\Log;
use timramseyjr\CartRecovery\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use timramseyjr\CartRecovery\Models\CartRecovery;

class RemoveCartRecovery
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductDeleted  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        if($event->order && !is_null($event->order->fields)) {
            $field_values = $event->order->fields;
            if(array_key_exists('Email',$field_values)){
                $open_carts = CartRecovery::where('email',$field_values['Email'])->where('complete',0)->get();
                foreach($open_carts as $cart){
                    if($cart->email_count == 0){
                        $cart->update(['complete' => 1,'normal' => 1]);
                    }else{
                        $cart->update(['complete' => 1,'recovered' => 1]);
                    }
                }
            }
        }
    }
}

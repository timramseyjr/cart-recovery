<?php

namespace timramseyjr\CartRecovery\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use timramseyjr\CartRecovery\Models\CartRecovery;

class CartRecoveryController extends BaseController{

    public function __construct(){

    }
    public function set(Request $request){
        $return = '';
        if($request->has('cart') && $request->has('email')){
            $recovery = CartRecovery::firstOrNew(['email' => $request->input('email')]);
            $recovery->name = $request->input('name');
            $recovery->email = $request->input('email');
            $recovery->cart = json_encode($request->input('cart'));
            Log::info(print_r($recovery->toArray(),true));
            $recovery->save();
            //return response()->json($recovery->toArray());
        }

    }
    public function get(Request $request){
        if($request->has('id')){
            $cart = CartRecovery::find($request->input('id'));
            return $cart;
        }
    }
}

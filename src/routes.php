<?php

Route::prefix('api')->group(function () {
    Route::group(['middleware' => ['api']], function () {
        Route::get('recover','timramseyjr\CartRecovery\Controllers\CartRecoveryController@set');
        Route::get('recover/cart','timramseyjr\CartRecovery\Controllers\CartRecoveryController@get');
    });
});
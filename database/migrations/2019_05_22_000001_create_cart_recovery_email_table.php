<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartRecoveryEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_recovery_email', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recovery_id')->unsigned();
            $table->text('email');
            $table->tinyInteger('email_number');
            $table->foreign('recovery_id')->references('id')->on('cart_recovery_data')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_recovery_email');
    }
}

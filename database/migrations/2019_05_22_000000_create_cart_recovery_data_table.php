<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartRecoveryDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_recovery_data', function (Blueprint $table) {
            $table->increments('id');
            $table->text('cart');
            $table->string('name')->nullable();
            $table->string('email');
            $table->text('user_info')->nullable();
            $table->tinyInteger('email_count')->default(0);
            $table->tinyInteger('recovered')->default(0);
            $table->tinyInteger('normal')->default(0);
            $table->tinyInteger('complete')->default(0);
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
        Schema::dropIfExists('cart_recovery_data');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ewallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ewallet_wallet', function (Blueprint $table) {
            $table->increments('id');

            $table->string('user_id', 255);
            $table->string('nama', 255);
            $table->string('ip_domisili', 255);
            $table->bigInteger('saldo');

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
        //
        Schema::dropIfExists('ewallet_wallet');
    }
}

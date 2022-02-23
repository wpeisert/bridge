<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidding_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bidding_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->smallInteger('user_no');
            $table->boolean('should_bid');
            $table->timestamps();

            $table->foreign('bidding_id')->references('id')->on('biddings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bidding_user');
    }
};
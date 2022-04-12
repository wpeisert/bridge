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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bidding_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->comment('User that placed the bid')->default(0);
            $table->integer('bidding_lp')->comment('Enumerates bids in the linking bidding');
            $table->string('bid')->comment('pass, 1c, 1d, 1h, 1s, 1nt, 7nt, dbl, rdbl');
            $table->timestamps();

            $table->foreign('bidding_id')->references('id')->on('biddings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
};

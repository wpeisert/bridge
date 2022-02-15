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
        Schema::create('bidding', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('deal_id')->unsigned();
            $table->smallInteger('current_user_no')->comment("0, 1, 2, 3");
            $table->string('status')->comment('preparing, pending, finished');
            $table->text('comments');
            $table->timestamps();
            $table->foreign('deal_id')->references('id')->on('deal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bidding');
    }
};

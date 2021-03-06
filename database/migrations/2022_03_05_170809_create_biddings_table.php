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
        Schema::create('biddings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('deal_id')->unsigned();
            $table->bigInteger('training_id')->unsigned();
            $table->string('current_player')->comment("N, E, S, W");
            $table->string('status')->comment('preparing, pending, finished');
            $table->string('contract')->default('');
            $table->decimal('result_NS')->default(0);
            $table->decimal('result_WE')->default(0);
            $table->foreign('deal_id')->references('id')->on('deals');
            $table->foreign('training_id')->references('id')->on('trainings');
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
        Schema::dropIfExists('biddings');
    }
};

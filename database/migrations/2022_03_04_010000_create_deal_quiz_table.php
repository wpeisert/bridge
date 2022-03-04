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
        Schema::create('deal_quiz', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('deal_id')->unsigned();
            $table->bigInteger('quiz_id')->unsigned();
            $table->timestamps();

            $table->unique(['deal_id', 'quiz_id']);

            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_quiz');
    }
};

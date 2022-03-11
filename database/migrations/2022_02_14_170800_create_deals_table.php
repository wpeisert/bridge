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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('cards_0')->default('');
            $table->string('cards_1')->default('');
            $table->string('cards_2')->default('');
            $table->string('cards_3')->default('');
            $table->integer('vulnerable_02')->default(0);
            $table->integer('vulnerable_13')->default(0);
            $table->smallInteger('dealer')->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('deals');
    }
};

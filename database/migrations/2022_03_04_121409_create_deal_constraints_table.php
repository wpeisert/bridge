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
        Schema::create('deal_constraints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->smallInteger('vulnerable');
            $table->smallInteger('dealer');

            for ($iter = 0; $iter < \App\Dictionaries\BridgeConstants::PLAYERS_COUNT; ++$iter) {
                $table->integer('PC_' . ($iter) . '_from');
                $table->integer('PC_' . ($iter) . '_to');
            }
            $table->integer('PC_any_player_from');
            $table->integer('PC_any_player_to');

            $table->integer('PC_02_from');
            $table->integer('PC_02_to');
            $table->integer('PC_13_from');
            $table->integer('PC_13_to');
            $table->integer('PC_any_pair_from');
            $table->integer('PC_any_pair_to');

            foreach (\App\Dictionaries\BridgeConstants::DEAL_CONSTRAINTS_COLORS as $color) {
                for ($iter = 0; $iter < \App\Dictionaries\BridgeConstants::PLAYERS_COUNT; ++$iter) {
                    $table->integer($color . '_' . ($iter) . '_from');
                    $table->integer($color . '_' . ($iter) . '_to');
                }
            }

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
        Schema::dropIfExists('deal_constraints');
    }
};

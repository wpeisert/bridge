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
            foreach (\App\BridgeCore\Constants::PLAYERS_NAMES as $playerName) {
                $table->string('cards_' . $playerName)->default('');
            }
            $table->integer('vulnerable_NS')->default(0);
            $table->integer('vulnerable_WE')->default(0);
            $table->string('dealer');
            $table->text('description')->nullable();

            $table->string('minimax_contract_NS')->nullable();
            $table->decimal('minimax_ev_NS')->nullable();
            $table->string('minimax_contract_WE')->nullable();
            $table->decimal('minimax_ev_WE')->nullable();

            $table->longtext('tricks_probabilities_NS')->nullable();
            $table->longtext('tricks_probabilities_WE')->nullable();

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

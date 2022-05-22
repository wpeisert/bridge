<?php

use App\BridgeCore\Tools;
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
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('vulnerable_NS');
            $table->smallInteger('vulnerable_WE');
            $table->string('dealer');

            foreach (Tools::getDealConstraintFields() as $name => $field) {
                $table->integer($name)->default($field['defaultValue']);
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

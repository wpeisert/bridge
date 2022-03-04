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

            foreach (\App\Models\DealConstraint::getFieldsNames() as $fieldName) {
                $table->integer($fieldName);
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

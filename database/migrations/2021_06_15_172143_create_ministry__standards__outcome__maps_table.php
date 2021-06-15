<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistryStandardsOutcomeMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry__standards__outcome__maps', function (Blueprint $table) {
            $table->unsignedBigInteger('l_outcome_id');
            $table->unsignedBigInteger('ministry_standard_id');
            $table->string('map_scale_value');
            $table->timestamps();

            $table->primary(['l_outcome_id','ministry_standard_id']);
            $table->foreign('l_outcome_id')->references('l_outcome_id')->on('learning_outcomes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ministry_standard_id')->references('ministry_standard_id')->on('ministry__standards')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ministry__standards__outcome__maps');
    }
}

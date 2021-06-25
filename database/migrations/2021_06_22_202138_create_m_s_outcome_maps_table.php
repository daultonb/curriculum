<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSOutcomeMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_s_outcome_maps', function (Blueprint $table) {
            $table->unsignedBigInteger('ministry_standard_id');
            $table->unsignedBigInteger('l_outcome_id');
            $table->string('map_scale_value');
            $table->timestamps();

            $table->primary(['ministry_standard_id', 'l_outcome_id']);
            $table->foreign('l_outcome_id')->references('l_outcome_id')->on('learning_outcomes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ministry_standard_id')->references('ministry_standard_id')->on('ministry_standards')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_s_outcome_maps');
    }
}

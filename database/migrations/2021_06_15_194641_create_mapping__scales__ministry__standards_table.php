<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingScalesMinistryStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping__scales__ministry__standards', function (Blueprint $table) {
            $table->bigIncrements('ministry_scale');
            $table->string('title');
            $table->string('abbreviation');
            $table->string('description');
            $table->char('colour', 7);
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
        Schema::dropIfExists('mapping__scales__ministry__standards');
    }
}

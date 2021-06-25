<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistryStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry_standards', function (Blueprint $table) {
            $table->bigIncrements('ministry_standard_id');
            $table->unsignedBigInteger('msc_id')->default(1);
            $table->string('ms_shortphrase');
            $table->text('ms_outcome');
            $table->timestamps();

            $table->foreign('msc_id')->references('msc_id')->on('ministry_standard_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ministry_standards');
    }
}

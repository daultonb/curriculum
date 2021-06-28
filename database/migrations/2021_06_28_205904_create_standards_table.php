<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standards', function (Blueprint $table) {
            $table->bigIncrements('standard_id');
            $table->unsignedBigInteger('sc_id')->default(1);
            $table->string('s_shortphrase');
            $table->text('s_outcome');
            $table->timestamps();

            $table->foreign('sc_id')->references('sc_id')->on('standard_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standards');
    }
}

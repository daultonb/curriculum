<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOptionalPrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('optional_priorities', function ($table) {
            $table->unsignedBigInteger('op_id');
            $table->primary('op_id');
            $table->unsignedBigInteger('subcat_id');
            $table->text('optional_priority');

            $table->foreign('subcat_id')->references('subcat_id')->on('optional_priority_subcategories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('optional_priorities', function ($table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('custom_PLO');
            $table->unsignedBigInteger('input_status');

            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}

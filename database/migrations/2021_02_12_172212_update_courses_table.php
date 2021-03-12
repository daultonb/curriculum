<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('section')->length(20)->after('course_num');
            $table->char('semester')->length(2)->after('course_num');
            $table->integer('year')->length(4)->after('course_num');
            $table->char('delivery_modality')->length(1)->after('course_num');
            $table->string('course_num')->length(30)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('section');
            $table->dropColumn('semester');
            $table->dropColumn('year');
            $table->dropColumn('delivery_modality');
            $table->unsignedBigInteger('course_num')->change();
        });
    }
}

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
        Schema::table('optional_priorities', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropForeign('optional_priorities_course_id_foreign');
            $table->dropColumn('course_id');
            $table->dropColumn('custom_PLO');
            $table->dropColumn('input_status');

            $table->unsignedBigInteger('op_id')->first();
            $table->primary('op_id');
            $table->unsignedBigInteger('subcat_id')->after('op_id');
            $table->text('optional_priority')->after('subcat_id');

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
        Schema::dropIfExists('optional_priorities');
    }
}

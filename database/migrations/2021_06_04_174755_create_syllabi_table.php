<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllabiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create syllabi table
        Schema::create('syllabi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->char('campus', 1);
            $table->string('course_instructor');
            $table->string('course_location')->nullable();
            $table->text('office_hours')->nullable();
            $table->char('class_meeting_days', 20)->nullable();
            $table->text('other_instructional_staff')->nullable();
            $table->string('class_start_time', 20)->nullable();
            $table->string('class_end_time', 20)->nullable();
            $table->text('learning_outcomes')->nullable();
            $table->text('assessments_of_learning')->nullable();
            $table->text('learning_activities')->nullable();
            $table->text('late_policy')->nullable();
            $table->text('missed_exam_policy')->nullable();
            $table->text('missed_activity_policy')->nullable();
            $table->text('passing_criteria')->nullable();
            $table->text('learning_materials')->nullable();
            $table->text('learning_resources')->nullable();
        });

        Schema::create('syllabi_users', function (Blueprint $table) {
            $table->unsignedBigInteger('syllabus_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->primary(['syllabus_id','user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('cascade')->onUpdate('cascade');
        });

        // update courses table
        Schema::table('courses', function(Blueprint $table) {
            // add course_create_method col
            $table->string('create_method', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // update courses table
        Schema::table('courses', function (Blueprint $table) {
            // delete course_create_method col
            $table->dropColumn('create_method');
        });   
        // delete syllabi_users table
        Schema::dropIfExists('syllabi_users');

        // delete syllabi table
        Schema::dropIfExists('syllabi');

    
    }
}

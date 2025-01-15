<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('social_sec_no');
            $table->integer('examiner_id');
            $table->string('age');
            $table->string('age_status_ok');
            $table->string('gender');
            $table->string('mail_address');
            $table->string('cell_no');
            $table->string('occupation');
            $table->string('driving_school_name');
            $table->string('department');
            $table->string('license_category');
            $table->string('start_date');
            $table->string('finish_date');
            $table->string('no_of_days_spent');
            $table->string('no_of_extra_lessons');
            $table->string('session_rate');
            $table->string('current_course_status');
            $table->string('close_track_date');
            $table->string('first_aid_course_date');
            $table->string('slippery_course_date');
            $table->string('theory_test_date_no_1');
            $table->string('theory_test_date_no_2');
            $table->string('theory_test_date_no_3');
            $table->string('theory_test_date_no_4');
            $table->string('theory_test_date_no_5');
            $table->string('theory_test_date_no_6');
            $table->string('theory_test_date_no_7');
            $table->string('practical_test_date_no_1');
            $table->string('examiners_name_town_and_district_1');
            $table->string('practical_test_date_no_2');
            $table->string('examiners_name_town_and_district_2');
            $table->string('practical_test_date_no_3');
            $table->string('examiners_name_town_and_district_3');
            $table->string('practical_test_date_no_4');
            $table->string('examiners_name_town_and_district_4');
            $table->string('practical_test_date_no_5');
            $table->string('examiners_name_town_and_district_5');
            $table->string('practical_test_date_no_6');
            $table->string('examiners_name_town_and_district_6');
            $table->string('practical_test_date_no_7');
            $table->string('examiners_name_town_and_district_7');
            $table->string('invoice_date');
            $table->string('invoice_amount');
            $table->string('completed_or_not');
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
        Schema::dropIfExists('students');
    }
}

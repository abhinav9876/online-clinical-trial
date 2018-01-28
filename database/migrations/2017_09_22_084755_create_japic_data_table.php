<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJapicDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('japic_data', function (Blueprint $table) {
            $table->increments('id');

            $table->string('areas')->nullable();
            $table->string('co_developer')->nullable();
            $table->string('company')->nullable();
            $table->string('company_sec')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact_sec')->nullable();
            // $table->string('date')->nullable(); // skip
            $table->string('department')->nullable();
            $table->string('department_sec')->nullable();
            $table->string('design')->nullable();
            $table->string('disease')->nullable();
            $table->text('eligibility')->nullable();
            $table->text('evaluation')->nullable();
            $table->string('exam_status')->nullable();
            $table->string('examiner')->nullable();
            $table->text('exclusion')->nullable();
            $table->text('facility')->nullable();
            $table->text('medic')->nullable();
            $table->string('period')->nullable();
            $table->string('phase')->nullable();
            $table->string('status')->nullable();
            $table->string('target')->nullable();
            $table->text('test_outline')->nullable();
            $table->text('test_purpose')->nullable();
            $table->string('test_type')->nullable();
            $table->string('title')->nullable();
            $table->string('title_short')->nullable();

            $table->integer('japic_id')->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('japic_data');
    }
}

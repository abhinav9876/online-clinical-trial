<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUminDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umin_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('umin_id')->index();

            $table->string('randomization')->nullable();
            $table->string('region')->nullable();
            $table->string('condition')->nullable();
            $table->string('classification_specialty')->nullable();
            $table->string('classification_malignancy')->nullable();
            $table->string('genomic')->nullable();
            $table->text('narrative')->nullable();
            $table->text('basic')->nullable();
            $table->text('others')->nullable();
            $table->string('trial_one')->nullable();
            $table->string('trial_two')->nullable();
            $table->string('phase')->nullable();
            $table->text('primary')->nullable();
            $table->text('secondary')->nullable();
            $table->string('studytype')->nullable();
            $table->text('basic_design')->nullable();
            $table->string('randomization_unit')->nullable();
            $table->string('blinding')->nullable();
            $table->string('control')->nullable();
            $table->string('stratification')->nullable();
            $table->text('dynamic')->nullable();
            $table->text('consideration')->nullable();
            $table->text('blocking')->nullable();
            $table->string('concealment')->nullable();
            $table->string('arms')->nullable();
            $table->string('intervention')->nullable();
            $table->string('type_intervention')->nullable();
            $table->string('control_one')->nullable();
            $table->string('age_lower')->nullable();
            $table->string('age_upper')->nullable();
            $table->string('gender')->nullable();
            $table->text('key_inclusion')->nullable();
            $table->text('key_exclusion')->nullable();
            $table->string('target_size')->nullable();
            $table->string('research_contact_name')->nullable();
            $table->string('research_organisation')->nullable();
            $table->string('research_division_name')->nullable();
            $table->string('research_address')->nullable();
            $table->string('research_tel')->nullable();
            $table->string('research_email')->nullable();
            $table->string('public_contact_name')->nullable();
            $table->string('public_organisation')->nullable();
            $table->string('public_division')->nullable();
            $table->string('public_address')->nullable();
            $table->string('public_tel')->nullable();
            $table->string('public_url')->nullable();
            $table->string('public_email')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('institute_secondery')->nullable();
            $table->string('name_of_secondary_founder')->nullable();
            $table->string('institutions')->nullable();

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
        Schema::dropIfExists('umin_data');
    }
}

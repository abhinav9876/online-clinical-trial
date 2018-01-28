<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJmacctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jmaccts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ctnnum')->nullable();
            // $table->string('date')->nullable(); // skip
            $table->string('dosfrm1')->nullable();
            $table->string('dosfrm2')->nullable();
            $table->string('dosfrm3')->nullable();
            $table->string('dosfrm4')->nullable();
            $table->string('dosfrm5')->nullable();
            $table->string('fdcntry1')->nullable();
            $table->string('fdcntry2')->nullable();
            $table->string('fdcntry3')->nullable();
            $table->string('fdorgtyp1')->nullable();
            $table->string('fdorgtyp2')->nullable();
            $table->string('fdorgtyp3')->nullable();
            $table->string('fdsrce1')->nullable();
            $table->string('fdsrce2')->nullable();
            $table->string('fdsrce3')->nullable();
            $table->string('geneinfo')->nullable();
            $table->string('indctyp')->nullable();
            $table->text('indic')->nullable();
            $table->string('intvtyp')->nullable();

            $table->string('jmacct_id')->nullable()->index();

            $table->string('jrgstdtc')->nullable();
            $table->string('nature')->nullable();
            $table->text('objprime')->nullable();
            $table->text('objsec')->nullable();
            $table->string('oncolo')->nullable();
            $table->string('phase')->nullable();
            $table->string('recrstat')->nullable();
            $table->string('rgstdtc')->nullable();
            $table->string('rgstprim')->nullable();
            $table->string('rgstsec1')->nullable();
            $table->string('rgstsec2')->nullable();
            $table->string('rgstsec3')->nullable();
            $table->string('rgstsec4')->nullable();
            $table->string('rgstsec5')->nullable();
            $table->string('sponsor')->nullable();
            $table->text('spsec')->nullable();
            $table->string('stuidsec1')->nullable();
            $table->string('stuidsec2')->nullable();
            $table->string('stuidsec3')->nullable();
            $table->string('stuidsec4')->nullable();
            $table->string('stuidsec5')->nullable();
            $table->text('summary')->nullable();
            $table->string('thpyarea')->nullable();
            $table->text('title')->nullable();
            $table->string('titlecd')->nullable();
            $table->text('titlepub')->nullable();
            $table->string('trt1')->nullable();
            $table->string('trt2')->nullable();
            $table->string('trt3')->nullable();
            $table->string('trt4')->nullable();
            $table->string('trt5')->nullable();
            $table->string('trtdur1')->nullable();
            $table->string('trtdur2')->nullable();
            $table->string('trtdur3')->nullable();
            $table->string('trtdur4')->nullable();
            $table->string('trtdur5')->nullable();
            $table->string('type1')->nullable();
            $table->string('type2')->nullable();
            $table->string('type3')->nullable();
            $table->string('type4')->nullable();
            $table->string('type5')->nullable();
            // $table->string('update_date')->nullable(); // skip
            $table->string('ustudyid')->nullable();

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
        Schema::dropIfExists('jmaccts');
    }
}

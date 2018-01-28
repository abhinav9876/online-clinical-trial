<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJmacctDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jmacct_data', function (Blueprint $table) {
            $table->increments('id');

            $table->string('accepthv')->nullable();
            $table->string('agemax')->nullable();
            $table->string('agemaxu')->nullable();
            $table->string('agemin')->nullable();
            $table->string('ageminu')->nullable();
            $table->string('analdtc')->nullable();
            $table->string('armnum')->nullable();
            $table->string('blind')->nullable();
            $table->string('cntcaddr')->nullable();
            $table->string('cntcdepart')->nullable();
            $table->string('cntceml')->nullable();
            $table->string('cntcfax')->nullable();
            $table->string('cntcnam')->nullable();
            $table->string('cntcorg')->nullable();
            $table->string('cntctel')->nullable();
            $table->string('comptrt1')->nullable();
            $table->string('comptrt2')->nullable();
            $table->string('comptrt3')->nullable();
            $table->string('conceal')->nullable();
            $table->string('control')->nullable();
            $table->string('country')->nullable();
            $table->string('ctdosfrm1')->nullable();
            $table->string('ctdosfrm2')->nullable();
            $table->string('ctdosfrm3')->nullable();
            $table->string('ctdosfrq1')->nullable();
            $table->string('ctdosfrq2')->nullable();
            $table->string('ctdosfrq3')->nullable();
            $table->string('ctdosrgm1')->nullable();
            $table->string('ctdosrgm2')->nullable();
            $table->string('ctdosrgm3')->nullable();
            $table->string('ctdostxt1')->nullable();
            $table->string('ctdostxt2')->nullable();
            $table->string('ctdostxt3')->nullable();
            $table->string('ctdosu1')->nullable();
            $table->string('ctdosu2')->nullable();
            $table->string('ctdosu3')->nullable();
            $table->string('ctfrqtxt1')->nullable();
            $table->string('ctfrqtxt2')->nullable();
            $table->string('ctfrqtxt3')->nullable();
            $table->string('ctroute1')->nullable();
            $table->string('ctroute2')->nullable();
            $table->string('ctroute3')->nullable();
            $table->string('cttrtdur1')->nullable();
            $table->string('cttrtdur2')->nullable();
            $table->string('cttrtdur3')->nullable();
            // $table->string('date')->nullable(); // skip
            $table->text('design')->nullable();
            $table->string('dose1')->nullable();
            $table->string('dose2')->nullable();
            $table->string('dose3')->nullable();
            $table->string('dose4')->nullable();
            $table->string('dose5')->nullable();
            $table->string('dosfrq1')->nullable();
            $table->string('dosfrq2')->nullable();
            $table->string('dosfrq3')->nullable();
            $table->string('dosfrq4')->nullable();
            $table->string('dosfrq5')->nullable();
            $table->string('dosrgm1')->nullable();
            $table->string('dosrgm2')->nullable();
            $table->string('dosrgm3')->nullable();
            $table->string('dosrgm4')->nullable();
            $table->string('dosrgm5')->nullable();
            $table->string('dostxt1')->nullable();
            $table->string('dostxt2')->nullable();
            $table->string('dostxt3')->nullable();
            $table->string('dostxt4')->nullable();
            $table->string('dostxt5')->nullable();
            $table->string('dosu1')->nullable();
            $table->string('dosu2')->nullable();
            $table->string('dosu3')->nullable();
            $table->string('dosu4')->nullable();
            $table->string('dosu5')->nullable();
            $table->string('dtclodtc')->nullable();
            $table->string('dtlckdtc')->nullable();
            $table->string('ethcappr')->nullable();
            $table->text('excl')->nullable();
            $table->string('fpidtc')->nullable();
            $table->string('frqtxt1')->nullable();
            $table->string('frqtxt2')->nullable();
            $table->string('frqtxt3')->nullable();
            $table->string('frqtxt4')->nullable();
            $table->string('frqtxt5')->nullable();
            $table->string('fuendtc')->nullable();
            $table->text('incl')->nullable();
            $table->string('invaddr')->nullable();
            $table->string('invdept')->nullable();
            $table->string('invfax')->nullable();
            $table->string('invnam')->nullable();
            $table->string('invorg')->nullable();
            $table->string('invtel')->nullable();
            $table->string('irbdtc')->nullable();

            $table->integer('jmacct_id')->nullable()->index();

            $table->string('jpnpref')->nullable();
            $table->text('othinfo')->nullable();
            $table->string('out1meas')->nullable();
            $table->string('out1tpt')->nullable();
            $table->string('out2meas')->nullable();
            $table->string('out2tot')->nullable();
            $table->text('outprim')->nullable();
            $table->text('outsec')->nullable();
            $table->string('plansub')->nullable();
            $table->string('prtcldtc')->nullable();
            $table->string('ranbloc')->nullable();
            $table->string('random')->nullable();
            $table->string('randynmc')->nullable();
            $table->string('ranstrat')->nullable();
            $table->string('ranu')->nullable();
            $table->string('respubl')->nullable();
            $table->string('route1')->nullable();
            $table->string('route2')->nullable();
            $table->string('route3')->nullable();
            $table->string('route4')->nullable();
            $table->string('route5')->nullable();
            $table->string('sexpop')->nullable();
            $table->string('sitenum')->nullable();
            $table->string('sitetyp')->nullable();
            $table->string('studendtc')->nullable();
            $table->string('studyurl')->nullable();
            $table->string('stustdtc')->nullable();
            // $table->string('update_date')->nullable(); // skip

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
        Schema::dropIfExists('jmacct_data');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->text('decimal_representation');
            $table->text('asn');
            $table->text('city');
            $table->text('country');
            $table->text('country_code');
            $table->text('isp');
            $table->text('latitude');
            $table->text('longitude');
            $table->text('organization');
            $table->text('postal_code');
            $table->text('is_private');
            $table->text('ptr_resource');
            $table->text('is_reserved');
            $table->text('state');
            $table->text('state_code');
            $table->text('timezone');
            $table->text('local_time');


            $table->text('subnet');
            $table->text('net_size');
            $table->text('registrant');
            $table->text('another_country');

            $table->text('subnet_2');
            $table->text('net_size_2');
            $table->text('registrant_2');
            $table->text('another_country_2');


            $table->integer('list_id')->unsigned();
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
        Schema::dropIfExists('ip_datas');
    }
}

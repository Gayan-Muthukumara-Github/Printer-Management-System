<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report__details', function (Blueprint $table) {
            $table->id();
            $table->integer('printer_id');
            $table->string('printer_model');
            $table->string('no_of_units');
            $table->string('total_mono');
            $table->string('total_color');
            $table->string('mono_value');
            $table->string('color_value');
            $table->string('total_mono_price');
            $table->string('total_color_price');
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
        Schema::dropIfExists('report__details');
    }
}

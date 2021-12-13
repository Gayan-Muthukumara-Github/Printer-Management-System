<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatecardPrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratecard_printers', function (Blueprint $table) {
            $table->id();
            $table->integer("ratecard_id");
            $table->integer("printr_id")->nullable();
            $table->string("commitment")->nullable();
            $table->string("commitment_1")->nullable();
            $table->string("monochrome")->nullable();
            $table->string("color")->nullable();

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
        Schema::dropIfExists('ratecard_printers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatafeedDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datafeed_details', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('datafeed_id');
            $table->integer('printer_id');
            $table->integer('previous_page_count');
            $table->integer('total_page_count');
            $table->integer('previous_mono_page_count');
            $table->integer('previous_colour_page_count');            
            $table->integer('mono_page_count');
            $table->integer('colour_page_count');
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
        Schema::dropIfExists('datafeed_details');
    }
}

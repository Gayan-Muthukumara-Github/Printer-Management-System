<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilteredDatafeedDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filtered_datafeed_details', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('datafeed_id');
            $table->integer('printer_id');
            $table->string('total_page_count');
            $table->string('mono_page_count');
            $table->string('colour_page_count');
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
        Schema::dropIfExists('filtered_datafeed_details');
    }
}

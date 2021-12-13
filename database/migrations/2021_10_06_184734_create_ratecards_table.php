<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatecardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratecards', function (Blueprint $table) {
            $table->id();
            $table->integer("company_id");
            $table->integer("customer_id");
            $table->string("type");
            $table->boolean("apply_exchange")->nullable();
            $table->string("exchange_diff")->nullable();
            $table->string("monochrome")->nullable();
            $table->string("print_volume")->nullable();
            $table->boolean("group_wise")->nullable();
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
        Schema::dropIfExists('ratecards');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TempCompanyPrinters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_company_printers', function (Blueprint $table) {
            $table->id();
            $table->integer("company_id");
            $table->integer("customer_id");
            $table->string("serial_number");
            $table->string("printer_model");
            $table->string("status");
            $table->string("dip_cost");
            $table->string("branch");
            $table->string("department");
            $table->string("con_method");
            $table->string("installation_at");
            $table->string("start_page_count");
            $table->string("duty_cycle");
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
        Schema::dropIfExists('temp_company_printers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string("contract_id");
            $table->string("company_id");
            $table->string("name")->nullable();;
            $table->string("customer_id")->nullable();;
            $table->string("contract_type")->nullable();;
            $table->string("master_contract")->nullable();;
            $table->integer("monthly_commitment")->nullable();;
            $table->date("contract_signed_at")->nullable();;
            $table->string("exchange_rate")->nullable();;
            $table->integer("rate_card_id")->nullable();;
            $table->string("service_level")->nullable();;
            $table->string("contract_contact_person")->nullable();;
            $table->string("upload")->nullable();;
            $table->string("salient_point_1")->nullable();;
            $table->string("salient_point_2")->nullable();;
            $table->string("salient_point_3")->nullable();;
            $table->string("salient_point_4")->nullable();;
            $table->string("salient_point_5")->nullable();;
            $table->string("salient_point_6")->nullable();;
            $table->string("salient_point_7")->nullable();;
            $table->string("salient_point_8")->nullable();;
            $table->string("salient_point_9")->nullable();;
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
        Schema::dropIfExists('contracts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //image column need to added
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('uen')->nullable();
            $table->date('fye')->nullable();
            $table->date('last_ar_filed')->nullable();
            $table->date('last_agm_filed')->nullable();
            $table->string('gst_reg_no')->nullable();
            $table->date('incorporation_date')->nullable();
            $table->string('company_age')->nullable();
            $table->string('no_of_employees')->nullable();
            $table->string('no_of_offices')->nullable();
            $table->longText('address_line')->nullable();
            $table->enum('status',['active', 'expired'])->default('active');
            $table->string('image')->nullable();

            $table->foreignId('created_by');
            $table->foreignId('primary_industry_service_ssic_id')->nullable();
            $table->foreignId('secondary_industry_service_ssic_id')->nullable();

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
        Schema::dropIfExists('companies');
    }
};

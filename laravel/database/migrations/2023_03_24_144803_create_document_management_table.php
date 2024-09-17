<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentManagementTable extends Migration
{
    /**
     * Run the migrations.
     * TODO
     * make a column downloaded at
     * @return void
     */
    public function up()
    {
        Schema::create('document_management', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document_id');
            $table->string('file');
            $table->dateTime('invited_at')->nullable();
//            $table->enum('status',['active', 'closed'])->default('active');
            $table->enum('status',['pending', 'completed'])->default('pending');
            $table->foreignId('company_id');
            $table->foreignId('service_id');
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
        Schema::dropIfExists('document_management');
    }
}

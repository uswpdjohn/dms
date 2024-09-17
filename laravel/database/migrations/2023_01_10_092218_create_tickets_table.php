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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('ticket_no');
            $table->string('file')->nullable();
            $table->longText('message');
            $table->longText('admin_reply')->nullable();
            $table->enum('status',['open', 'closed']);

            $table->foreignId('category_id');
            $table->foreignId('company_id');
            $table->foreignId('issuer_id');
            $table->foreignId('reviewer_id')->nullable();

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
        Schema::dropIfExists('tickets');
    }
};

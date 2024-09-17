<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->id();
            $table->mediumText('slug');
            $table->string('from');
            $table->string('directory');
            $table->longText('short_message')->nullable();
            $table->string('category')->nullable();
            $table->mediumText('title')->nullable();
            $table->string('file')->nullable();
            $table->string('priority')->default('new');
            $table->dateTime('read_at')->nullable();
            $table->dateTime('downloaded_at')->nullable();
            $table->foreignId('company_id');

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
        Schema::dropIfExists('mailboxes');
    }
}

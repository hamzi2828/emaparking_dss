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
        Schema::create('parsed_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->string('subject')->nullable();
            $table->text('html')->nullable();
            $table->text('text')->nullable();
            $table->text('attachments')->nullable();
            $table->enum('status',['pending','processing','success', 'failed'])->default('pending');
            $table->text('error')->nullable();
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
        Schema::dropIfExists('parsed_emails');
    }
};

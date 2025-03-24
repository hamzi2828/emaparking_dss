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
        Schema::create('booking_update_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->text('revision');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('editor_id');
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
        Schema::dropIfExists('booking_update_reasons');
    }
};

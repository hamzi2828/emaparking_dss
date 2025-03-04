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
        Schema::table('bravo_bookings', function (Blueprint $table) {
            $table->string('collection_time')->nullable();
            $table->string('return_time')->nullable();
            $table->string('vehicle_registration')->nullable();
            $table->string('vehicle_manufacture')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bravo_bookings', function (Blueprint $table) {
            $table->dropColumn('collection_time');
            $table->dropColumn('return_time');
            $table->dropColumn('vehicle_registration');
            $table->dropColumn('vehicle_manufacture');
            $table->dropColumn('vehicle_model');
            $table->dropColumn('vehicle_color');
        });
    }
};

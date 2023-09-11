<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookingfood', function (Blueprint $table) {
            $table->id('idBookingFood');
            $table->bigInteger('idBookingTable')->unsigned();
            $table->bigInteger('idFood')->unsigned();
            $table->integer('amountBF')->unsigned()->default(1);
            $table->float('priceBF');
            $table->foreign('idBookingTable')->references('idBookingTable')->on('bookingtable')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idFood')->references('idFood')->on('food')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingfood');
    }
};

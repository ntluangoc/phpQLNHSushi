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
        Schema::create('bill', function (Blueprint $table) {
            $table->id('idBill');
            $table->bigInteger('idBookingTable')->unsigned()->nullable()->default(null);
            $table->bigInteger('idCart')->unsigned()->nullable()->default(null);
            $table->date('dateBill');
            $table->time('timeBill');
            $table->float('sumPrice');
            $table->float('discount')->default(0);
            $table->float('discountGiftCode')->default(0);
            $table->foreign('idBookingTable')->references('idBookingTable')->on('bookingtable')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idCart')->references('idCart')->on('cart')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill');
    }
};

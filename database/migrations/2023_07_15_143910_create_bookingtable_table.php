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
        Schema::create('bookingtable', function (Blueprint $table) {
            $table->id('idBookingTable');
            $table->bigInteger('idUser')->unsigned();
            $table->bigInteger('idTable')->unsigned();
            $table->integer('amountBT')->unsigned();
            $table->date('dateBT');
            $table->time('timeBT');
            $table->string('noteBT')->nullable();
            $table->boolean('isCheckin')->default(false);
            $table->foreign('idUser')->references('idUser')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idTable')->references('idTable')->on('table')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingtable');
    }
};

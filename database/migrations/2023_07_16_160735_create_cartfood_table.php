<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cartfood', function (Blueprint $table) {
            $table->id('idCartFood');
            $table->bigInteger('idCart')->unsigned();
            $table->bigInteger('idFood')->unsigned();
            $table->integer('amountCF')->unsigned()->default(1);
            $table->datetime('datetimeCF')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->float('priceCF');
            $table->boolean('isPay')->default(false);
            $table->foreign('idCart')->references('idCart')->on('cart')
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
        Schema::dropIfExists('cartfood');
    }
};

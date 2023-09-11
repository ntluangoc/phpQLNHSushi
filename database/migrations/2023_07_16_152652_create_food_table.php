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
        Schema::create('food', function (Blueprint $table) {
            $table->id('idFood');
            $table->string('nameFood');
            $table->float('priceFood');
            $table->string('typeFood', 20);
            $table->integer('forPerson')->unsigned();
            $table->integer('amountFood')->unsigned();
            $table->string('imgFood')->nullable();
            $table->boolean('isActive')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};

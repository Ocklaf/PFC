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
        Schema::create('apiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('place_id')->unique();
            $table->date('last_visit')->nullable();
            $table->date('next_visit')->nullable();
            $table->integer('beehives_quantity');
            $table->boolean('clear_apiary');
            $table->boolean('refill_water');
            $table->boolean('collect_honey');
            $table->boolean('collect_pollen');
            $table->boolean('collect_apitoxine');
            $table->boolean('food');
            $table->text('others')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apiaries');
    }
};

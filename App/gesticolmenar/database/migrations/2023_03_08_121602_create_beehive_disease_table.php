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
        Schema::create('beehive_disease', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beehive_id');
            $table->unsignedBigInteger('disease_id');
            $table->foreign('beehive_id')->references('id')->on('beehives');
            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beehive_disease');
    }
};

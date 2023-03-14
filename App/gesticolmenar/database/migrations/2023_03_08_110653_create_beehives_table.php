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
        Schema::create('beehives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('apiary_id');
            $table->unsignedBigInteger('queen_id');
            $table->string('type');
            $table->integer('honey_frames');
            $table->integer('pollen_frames');
            $table->integer('brood_frames');
            //$table->integer('total_frames');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('apiary_id')->references('id')->on('apiaries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('queen_id')->references('id')->on('queens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beehives');
    }
};

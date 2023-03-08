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
        Schema::create('queens', function (Blueprint $table) {
            $table->id();
            $table->string('race');
            $table->string('color');
            $table->date('start_date');
            $table->date('end_date'); // Queens can be used for four years aproximately
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queens');
    }
};

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
            $table->unsignedBigInteger('user_id');
            $table->string('race');
            $table->string('color');
            //Existe un código internacional de colores aceptado por todos los apicultores que identifica el año de nacimiento de una reina: Azul (años terminados en 0 ó 5), Blanco (terminados en 1 ó 6), Amarillo (terminados en 2 ó 7), Rojo (terminados en 3 ó 8) y Verde (terminados en 4 ó 9).
            $table->string('start_date');
            $table->string('end_date'); // Queens can be used for five years aproximately
            $table->foreign('user_id')->references('id')->on('users');
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

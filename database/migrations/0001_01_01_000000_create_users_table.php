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
        // AQUÍ ADENTRO PEGAS EL ESQUEMA:
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            $table->string('name_user');
            $table->string('email')->unique(); 
            $table->string('password'); 
            $table->string('adress')->nullable(); 
            $table->string('city')->nullable();
            $table->integer('telephon')->nullable(); 
            
            // Campos de control que tienes en la captura
            $table->string('create_user')->nullable();
            $table->string('ipUser')->nullable();
            $table->string('sesionDesde')->nullable();
            $table->string('sesionHasta')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temporary_orders', function (Blueprint $table) {
            $table->id(); 
            
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            $table->integer('cantidad')->default(1);
            $table->string('token')->nullable(); 
            $table->timestamp('fecha')->useCurrent(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temporary_orders');
    }
};
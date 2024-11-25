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
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->nullable(); // Kolom untuk menyimpan URL atau path gambar
            $table->text('description')->nullable(); // Kolom untuk deskripsi produk
            $table->integer('stock')->default(0); // Kolom untuk stok produk
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['image', 'description', 'stock']);
        });
    }
};
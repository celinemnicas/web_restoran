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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id'); // Foreign key untuk menu
            $table->unsignedBigInteger('cart_id')->nullable(); // Foreign key untuk menu

            $table->enum('status', ['Pending', 'Proses', 'Siap Saji'])->default('Pending'); // Enum status pesanan dengan default PENDING
            $table->string('jenis_pesanan'); // Dine-in atau Takeaway
            $table->integer('nomor_meja')->nullable(); // Nomor meja untuk dine-in
            $table->time('jam_pengambilan')->nullable(); // Jam pengambilan untuk takeaway
            $table->text('informasi_pembeli')->nullable(); // Informasi kontak pembeli
            $table->integer('price'); // Kolom harga
            $table->integer('quantity'); // Kolom quantity

            $table->timestamps();
        
            // Relasi ke tabel menus
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

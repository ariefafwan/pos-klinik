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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->date('tanggal');
            $table->enum('type', ['Berobat', 'Pembelian']);
            $table->enum('status', ['Berjalan', 'Selesai'])->nullable();
            $table->bigInteger('total_item');
            $table->bigInteger('total_harga');
            $table->bigInteger('pemasukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

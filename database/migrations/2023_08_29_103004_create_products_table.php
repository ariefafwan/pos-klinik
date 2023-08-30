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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('categori_id')->unsigned();
            $table->foreign('categori_id')->references('id')->on('categoris')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('harga_jual');
            $table->bigInteger('harga_beli');
            $table->tinyInteger('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

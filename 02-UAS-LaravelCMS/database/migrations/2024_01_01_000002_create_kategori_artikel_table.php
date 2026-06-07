<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_artikel', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_kategori', 100)->unique();
            $table->text('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_artikel');
    }
};

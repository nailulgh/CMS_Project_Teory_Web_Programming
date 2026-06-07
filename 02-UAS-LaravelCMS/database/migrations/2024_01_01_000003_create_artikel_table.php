<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_penulis');
            $table->integer('id_kategori');
            $table->string('judul', 255);
            $table->text('isi');
            $table->string('gambar', 255);
            $table->string('hari_tanggal', 50);

            $table->foreign('id_penulis')
                  ->references('id')
                  ->on('penulis')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('id_kategori')
                  ->references('id')
                  ->on('kategori_artikel')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};

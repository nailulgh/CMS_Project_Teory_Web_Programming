<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penulis', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_depan', 100);
            $table->string('nama_belakang', 100);
            $table->string('user_name', 50)->unique();
            $table->string('password', 255);
            $table->string('foto', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penulis');
    }
};

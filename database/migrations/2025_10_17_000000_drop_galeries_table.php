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
        // Hapus tabel galeries (dengan single r) jika ada
        Schema::dropIfExists('galeries');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika ingin mengembalikan, buat ulang tabel galeries
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('photo_url');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->enum('category', ['osis', 'mpk']);
            $table->timestamp('uploaded_at');
            $table->timestamps();
        });
    }
};

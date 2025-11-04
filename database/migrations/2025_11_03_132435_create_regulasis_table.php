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
        // regulasi
        Schema::create('regulasis', function (Blueprint $table) {
            $table->id();
            $table->string('link')->nullable(); // URL atau file path
            $table->timestamps();
        });

        Schema::create('regulasi_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regulasi_id')->constrained('regulasis')->onDelete('cascade');
            $table->string('locale', 10);
            $table->string('title'); // Judul regulasi
            $table->text('deskripsi')->nullable(); // Penjelasan singkat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulasis');
        Schema::dropIfExists('regulasi_translations');
    }
};

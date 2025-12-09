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
        // resources
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->enum('type', ['report', 'database']);
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->string('image')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('file_type')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete(action: 'cascade');
            $table->timestamps();
        });

        // resource_translations
        Schema::create('resource_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')->constrained('resources')->onDelete('cascade');
            $table->string('locale', 10);
            $table->string('title');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // artikels
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->enum('type', ['action', 'case', 'alerta']);
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->date('published_at')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete(action: 'cascade');
            $table->timestamps();
        });

        // artikel_translations
        Schema::create('artikel_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artikel_id')->constrained('artikels')->onDelete('cascade');
            $table->string('locale', 10);
            $table->string('title');
            $table->text('deskripsi')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
        Schema::dropIfExists('resources_translations');
        Schema::dropIfExists('artikels');
        Schema::dropIfExists('artikels_translations');
        Schema::dropIfExists('regulasis');
        Schema::dropIfExists('regulasi_translations');
    }
};

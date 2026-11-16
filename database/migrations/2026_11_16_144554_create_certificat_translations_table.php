<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificate_translations', function (Blueprint $table) {
            $table->id();

            // ---------- ارتباط با جدول اصلی ----------
            $table->foreignId('certificate_id')
                ->constrained('certificates')
                ->cascadeOnDelete();

            // ---------- زبان ----------
            $table->enum('locale', ['fa', 'ar', 'en'])->index();

            // ---------- عنوان و توضیحات ----------
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // ---------- alt تصویر برای SEO ----------
            $table->string('image_alt')->nullable();

            // ---------- سئو ----------
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords')->nullable();

            $table->timestamps();

            // ---------- یکتا بودن ترکیب مدرک + زبان ----------
            $table->unique(['certificate_id', 'locale']);

            // ---------- یکتا بودن slug در هر زبان ----------
            $table->unique(['locale', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificate_translations');
    }
};

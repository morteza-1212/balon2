<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();

            // ---------- دسته‌بندی ----------
            $table->enum('category', [
                'license',        // مجوز فعالیت
                'standard',       // گواهینامه استاندارد
                'technical',      // تأییدیه فنی
                'registration',   // مدارک ثبتی
                'quality',        // کنترل کیفیت
                'other',          // سایر مستندات
            ])->default('other')->index();

            // ---------- فایل‌ها (مشترک بین همه زبان‌ها) ----------
            $table->string('image')->nullable();        // مسیر تصویر مدرک
            $table->string('file')->nullable();         // مسیر PDF

            // ---------- اطلاعات مدرک (مشترک) ----------
            $table->string('certificate_number')->nullable(); // شماره مدرک
            $table->string('issuer')->nullable();             // صادرکننده
            $table->date('issued_at')->nullable();            // تاریخ صدور
            $table->date('expires_at')->nullable();           // تاریخ انقضا

            // ---------- نمایش و ترتیب ----------
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_featured')->default(false);

            // ---------- آمار ----------
            $table->unsignedBigInteger('views')->default(0);

            // ---------- زمان‌ها ----------
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['is_active', 'category', 'sort_order'], 'cert_active_cat_order_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};

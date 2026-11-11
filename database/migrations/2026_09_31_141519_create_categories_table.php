<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // کد یکتا برای دسته (military / research / promotional)
            $table->string('code', 50)->unique();

            // تصویر دسته
            $table->string('image')->nullable();

            // آیکون دسته (FontAwesome)
            $table->string('icon', 50)->nullable();

            // رنگ بج دسته (HEX)
            $table->string('color_hex', 7)->nullable();

            // ترتیب نمایش
            $table->unsignedInteger('sort_order')->default(0);

            // فعال / غیرفعال
            $table->boolean('status')->default(true);

            // نمایش در دسته‌های ویژه
            $table->boolean('is_featured')->default(false);

            $table->timestamps();

            // ایندکس برای جستجو
            $table->index('status');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_tranlations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // fa / en / ar
            $table->string('locale', 5);

            // ---------- محتوای اصلی ----------
            $table->string('name');
            $table->string('slug');

            // توضیح کوتاه
            $table->text('short_description')->nullable();

            // توضیحات کامل
            $table->longText('description')->nullable();

            // مشخصات محصول (متنی/HTML)
            $table->longText('specifications')->nullable();

            // ویژگی‌های محصول (متنی/HTML)
            $table->longText('features')->nullable();

            // اطلاعات بسته‌بندی
            $table->text('packaging')->nullable();

            // اطلاعات حمل و نقل
            $table->text('shipping_info')->nullable();

            // ---------- SEO ----------
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // متن جایگزین تصویر
            $table->string('alt_text')->nullable();

            $table->timestamps();

            // هر محصول در هر زبان فقط یک ترجمه
            $table->unique(
                ['product_id', 'locale'],
                'product_trans_product_locale_unique'
            );

            // slug در هر زبان یکتا
            $table->unique(
                ['locale', 'slug'],
                'product_trans_locale_slug_unique'
            );

            $table->index('locale');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};

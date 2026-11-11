<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // ارتباط با دسته‌بندی
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // کد محصول
            $table->string('code', 100)->unique();

            // SKU
            $table->string('sku', 100)->nullable()->unique();

            // ---------- تصاویر ----------
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();

            // ---------- وضعیت ----------
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            // وضعیت موجودی
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'on_request'])
                ->default('on_request');

            // ---------- مشخصات فیزیکی بالن (مشترک همه دسته‌ها) ----------
            $table->decimal('height_m', 6, 2)->nullable();       // ارتفاع (متر)
            $table->decimal('diameter_m', 6, 2)->nullable();      // قطر (متر)
            $table->decimal('volume_m3', 10, 2)->nullable();      // حجم (متر مکعب)
            $table->decimal('weight_kg', 8, 2)->nullable();       // وزن خالی (کیلوگرم)
            $table->decimal('payload_kg', 8, 2)->nullable();      // ظرفیت حمل بار (کیلوگرم)
            $table->string('material', 120)->nullable();          // جنس بدنه
            $table->string('gas_type', 50)->nullable();           // گاز (هلیوم/هیدروژن)
            $table->unsignedInteger('max_altitude_m')->nullable();// حداکثر ارتفاع (متر)
            $table->decimal('flight_duration_h', 6, 2)->nullable();// مدت پرواز (ساعت)

            // ---------- فیلدهای اختصاصی نظامی ----------
            $table->enum('security_level', ['public', 'confidential', 'secret'])
                ->nullable();
            $table->decimal('radar_range_km', 8, 2)->nullable();   // برد رادار
            $table->string('camera_payload_type', 120)->nullable(); // نوع دوربین/محموله
            $table->enum('deployment_type', ['mobile', 'fixed', 'portable'])
                ->nullable();
            $table->boolean('encryption_capability')->default(false);
            $table->string('military_standard', 100)->nullable();  // MIL-STD-...
            $table->smallInteger('operating_temp_min')->nullable(); // °C
            $table->smallInteger('operating_temp_max')->nullable(); // °C
            $table->smallInteger('wind_resistance_kmh')->nullable();// مقاومت باد

            // ---------- فیلدهای اختصاصی پژوهشی ----------
            $table->string('research_field', 120)->nullable();     // حوزه پژوهشی
            $table->string('sensor_type', 120)->nullable();        // نوع سنسور
            $table->boolean('data_logger')->default(false);
            $table->enum('data_transmission', ['radio', 'gsm', 'satellite', 'none'])
                ->nullable();
            $table->string('lab_standard', 100)->nullable();
            $table->boolean('calibration_certificate')->default(false);
            $table->boolean('sampling_capability')->default(false);
            $table->boolean('custom_dimensions')->default(false);

            // ---------- فیلدهای اختصاصی تبلیغاتی ----------
            $table->enum('printing_method', ['digital', 'screen', 'sublimation'])
                ->nullable();
            $table->unsignedSmallInteger('print_resolution_dpi')->nullable();
            $table->unsignedTinyInteger('print_colors')->nullable();
            $table->decimal('print_area_m2', 6, 2)->nullable();
            $table->boolean('branding_led')->default(false);
            $table->enum('indoor_outdoor', ['indoor', 'outdoor', 'both'])
                ->nullable();
            $table->unsignedSmallInteger('inflatable_days')->nullable();
            $table->boolean('reusable')->default(false);
            $table->unsignedSmallInteger('setup_time_min')->nullable();
            $table->boolean('custom_logo')->default(false);

            // ---------- قیمت ----------
            $table->decimal('price_from', 15, 2)->nullable();       // قیمت شروع (ریال)
            $table->string('price_currency', 10)->default('IRR');

            $table->timestamps();

            // ---------- ایندکس‌ها ----------
            $table->index('category_id');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('sort_order');
            $table->index('stock_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

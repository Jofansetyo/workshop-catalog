<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('category')->default('Perawatan');
            $t->unsignedInteger('price')->default(0);
            $t->string('estimate')->nullable();
            $t->text('description')->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('brand')->nullable();
            $t->string('category')->default('Oli');
            $t->unsignedInteger('price')->default(0);
            $t->unsignedInteger('stock')->default(0);
            $t->string('image')->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
        Schema::create('bookings', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('customer_name');
            $t->string('phone', 20);
            $t->string('vehicle');
            $t->string('service');
            $t->dateTime('scheduled_at')->nullable();
            $t->text('complaint')->nullable();
            $t->string('status')->default('Menunggu')->index();
            $t->timestamps();
        });
        Schema::create('testimonials', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->unsignedTinyInteger('rating')->default(5);
            $t->text('body');
            $t->string('source')->default('WhatsApp');
            $t->boolean('is_visible')->default(true);
            $t->timestamps();
        });
        Schema::create('faqs', function (Blueprint $t) {
            $t->id();
            $t->string('question');
            $t->text('answer');
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
        });
        Schema::create('gallery_items', function (Blueprint $t) {
            $t->id();
            $t->string('caption');
            $t->string('kind')->default('Sesudah');
            $t->string('image')->nullable();
            $t->timestamps();
        });
        Schema::create('settings', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->text('value')->nullable();
        });
    }

    public function down(): void
    {
        foreach (['settings', 'gallery_items', 'faqs', 'testimonials', 'bookings', 'products', 'services'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};

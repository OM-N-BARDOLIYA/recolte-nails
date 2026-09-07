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
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('category')->default('Press-On Nails');
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(5.0);
            $table->integer('reviews_count')->default(0);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('main_image');
            $table->json('images')->nullable();
            $table->text('description')->nullable();
            $table->json('benefits')->nullable();
            $table->text('key_ingredients')->nullable();
            $table->string('how_to_use')->nullable();
            $table->json('shades')->nullable();
            $table->json('sizes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

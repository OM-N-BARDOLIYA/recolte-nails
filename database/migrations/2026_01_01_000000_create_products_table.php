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
            $table->string('category');
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(5.0);
            $table->integer('reviews_count')->default(0);
            $table->boolean('is_bestseller')->default(false);
            $table->string('main_image');
            $table->text('images');
            $table->text('description');
            $table->text('benefits');
            $table->text('key_ingredients');
            $table->string('how_to_use');
            $table->text('shades')->nullable();
            $table->text('sizes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

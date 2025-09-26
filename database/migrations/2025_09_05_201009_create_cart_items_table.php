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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('product_id'); // Eloquent morph column - Phone, Computers, Tablets, Accessories model
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 12, 2); // snapshot of price at add-to-cart
            $table->integer("in_stock"); // snapshot of product stock at add-to-cart
            $table->string('name');
            $table->string("image_path");
            $table->timestamps();

            $table->index(['name', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

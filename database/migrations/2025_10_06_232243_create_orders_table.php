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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->constrained()->onDelete("cascade");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("address");
            $table->string("apartment_name")->nullable();
            $table->string("phone_number");
            $table->string("country");
            $table->string("city");
            $table->string("postal_code")->nullable();
            $table->string("state");
            $table->string("reference");
            $table->string("payment_status")->default("pending");
            $table->timestamps();
            $table->index(['id', 'customer_id', "created_at"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

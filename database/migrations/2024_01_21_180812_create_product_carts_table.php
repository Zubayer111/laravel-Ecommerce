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
        Schema::create('product_carts', function (Blueprint $table) {
            $table->id();
            $table->string("size");
            $table->string("color");
            $table->string("qty");
            $table->string("price");

            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("id")->on("products")->restrictOnDelete();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_carts');
    }
};

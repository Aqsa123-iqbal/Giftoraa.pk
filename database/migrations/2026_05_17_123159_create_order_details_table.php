<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('detail_id'); // Primary Key
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade'); // Foreign Key
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade'); // Foreign Key
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
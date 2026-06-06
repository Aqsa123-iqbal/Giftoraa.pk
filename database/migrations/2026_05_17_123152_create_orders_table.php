<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('contact'); // 👈 Yeh line lazmi honi chahiye
        $table->string('country')->default('Pakistan');
        $table->string('first_name')->nullable();
        $table->string('last_name');
        $table->text('address');
        $table->string('apartment')->nullable();
        $table->string('city');
        $table->string('postal_code')->nullable();
        $table->string('phone');
        $table->string('billing_option');
        $table->decimal('subtotal', 10, 2);
        $table->decimal('shipping', 10, 2)->default(300.00);
        $table->decimal('total', 10, 2);
        $table->text('cart_items'); 
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
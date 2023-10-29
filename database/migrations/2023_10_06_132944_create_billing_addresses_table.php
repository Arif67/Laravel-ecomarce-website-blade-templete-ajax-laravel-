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
        Schema::create('billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to the user who placed the order
            $table->unsignedBigInteger('order_id'); // Reference to the order associated with this billing address
            $table->string('fist_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_addresses');
    }
};

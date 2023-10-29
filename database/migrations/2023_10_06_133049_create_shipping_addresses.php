<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to the user who placed the order
            $table->unsignedBigInteger('order_id'); // Reference to the order associated with this shipping address
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_addresses');
    }
};

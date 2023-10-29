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
        Schema::table('proudct_carts', function (Blueprint $table) {
            $table->string('guest_token')->nullable(); // Define the guest_token column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proudct_carts', function (Blueprint $table) {
            $table->dropColumn('guest_token'); // Rollback the migration by dropping the column
        });
    }
};

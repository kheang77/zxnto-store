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
        Schema::create('tbl_customer', function (Blueprint $table) {

            $table->id();
            $table->string('name', 255);
            $table->string('gender', 6);
            $table->string('phone', 100);
            $table->string('email', 255);
            $table->string('address', 500);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_customer');
    }
};

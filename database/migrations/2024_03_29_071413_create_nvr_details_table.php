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
        Schema::create('nvr_details', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('ip_address');
            $table->string('csrf_token')->nullable();
            $table->string('cookie')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nvr_details');
    }
};

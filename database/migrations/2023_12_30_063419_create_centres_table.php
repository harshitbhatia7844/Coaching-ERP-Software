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
        Schema::create('centres', function (Blueprint $table) {
            $table->id();
            $table->string('centre_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('mobile_no')->unique();
            $table->string('contact_person');
            $table->string('contact_email');
            $table->unsignedBigInteger('contact_no');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centres');
    }
};

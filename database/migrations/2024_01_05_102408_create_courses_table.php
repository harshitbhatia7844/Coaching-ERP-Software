<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_id')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('mrp');
            $table->integer('price');
            $table->string('branch_id');
            $table->integer('status');
            $table->foreign('branch_id')->references('branch_id')->on('branches')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

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
        Schema::create('admin_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_name');
            $table->string('category');
            $table->string('company');
            $table->string('location');
            $table->text('description');
            $table->string('tag_1')->nullable();
            $table->string('tag_2')->nullable();
            $table->string('tag_3')->nullable();
            $table->string('tag_4')->nullable();
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index('category');
            $table->index('company');
            $table->index('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_jobs');
    }
};

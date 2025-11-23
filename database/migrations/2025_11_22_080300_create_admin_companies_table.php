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
        Schema::create('admin_companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('industry');
            $table->text('about');
            $table->string('company_size');
            $table->integer('closecall_employees')->default(0);
            $table->string('hq');
            $table->string('location');
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index('industry');
            $table->index('company_name');
            $table->index('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_companies');
    }
};

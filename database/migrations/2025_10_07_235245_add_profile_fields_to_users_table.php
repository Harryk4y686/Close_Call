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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('location')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('banner_photo')->nullable();
            $table->string('resume_file')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('portfolio_file')->nullable();
            $table->integer('profile_completion_percentage')->default(10); // 10% for account setup
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'mobile_number', 
                'date_of_birth',
                'gender',
                'location',
                'postal_code',
                'profile_photo',
                'banner_photo',
                'resume_file',
                'cv_file',
                'portfolio_file',
                'profile_completion_percentage'
            ]);
        });
    }
};

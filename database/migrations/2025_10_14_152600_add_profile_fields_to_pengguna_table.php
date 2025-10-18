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
        Schema::table('pengguna', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('country');
            $table->date('date_of_birth')->nullable()->after('profile_picture');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('location')->nullable()->after('gender');
            $table->string('postal_code')->nullable()->after('location');
            $table->string('resume_path')->nullable()->after('postal_code');
            $table->string('cv_path')->nullable()->after('resume_path');
            $table->string('portfolio_path')->nullable()->after('cv_path');
            $table->string('banner_image')->nullable()->after('portfolio_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn([
                'profile_picture',
                'date_of_birth',
                'gender',
                'location',
                'postal_code',
                'resume_path',
                'cv_path',
                'portfolio_path',
                'banner_image'
            ]);
        });
    }
};

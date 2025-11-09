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
        Schema::table('pengguna_registered', function (Blueprint $table) {
            // Add user_id column to support both User and Pengguna relationships
            $table->unsignedBigInteger('user_id')->nullable()->after('pengguna_id');
            
            // Add foreign key constraint for users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Make pengguna_id nullable since we now support both User and Pengguna
            $table->unsignedBigInteger('pengguna_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna_registered', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Drop user_id column
            $table->dropColumn('user_id');
            
            // Make pengguna_id not nullable again
            $table->unsignedBigInteger('pengguna_id')->nullable(false)->change();
        });
    }
};

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
            // Add admin_user_id column
            $table->unsignedBigInteger('admin_user_id')->nullable()->after('pengguna_id');
            
            // Make pengguna_id nullable (so profile can belong to either admin_user OR pengguna)
            $table->unsignedBigInteger('pengguna_id')->nullable()->change();
            
            // Add foreign key constraint
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna_registered', function (Blueprint $table) {
            $table->dropForeign(['admin_user_id']);
            $table->dropColumn('admin_user_id');
            
            // Restore pengguna_id as not nullable
            $table->unsignedBigInteger('pengguna_id')->nullable(false)->change();
        });
    }
};

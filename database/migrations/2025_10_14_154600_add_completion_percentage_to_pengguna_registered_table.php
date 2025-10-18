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
            $table->integer('completion_percentage')->default(0)->after('banner_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna_registered', function (Blueprint $table) {
            $table->dropColumn('completion_percentage');
        });
    }
};

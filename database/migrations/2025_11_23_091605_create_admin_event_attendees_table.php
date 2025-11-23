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
        Schema::create('admin_event_attendees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_event_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            // Prevent duplicate attendance
            $table->unique(['admin_event_id', 'user_id']);
            
            // Foreign keys
            $table->foreign('admin_event_id')->references('id')->on('admin_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_event_attendees');
    }
};

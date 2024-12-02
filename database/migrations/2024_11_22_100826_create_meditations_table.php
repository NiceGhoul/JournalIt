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
        Schema::create('meditations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('name');
            $table->date('date_added');
            $table->date('done_date')->nullable();
            $table->string('status');
            $table->string('logo')->nullable();
            // $table->foreignId('analytic_id')->constrained('analytics')->onDelete('cascade')->nullable();     
            // current time     
            $table->time('timer');
            // time set by user
            $table->time('target_timer');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meditations');
    }
};

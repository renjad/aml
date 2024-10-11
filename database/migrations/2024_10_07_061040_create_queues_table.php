<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('number');
            $table->string('patient_name')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('removed_by')->nullable()->constrained('users');
            $table->enum('status', ['waiting', 'calling', 'serving', 'served', 'inquired', 'hold']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};

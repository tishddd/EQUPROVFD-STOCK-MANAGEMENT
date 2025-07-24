<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id')->unique(); // Example: BAT-2025-03-12-001
            $table->date('batch_date');
            $table->text('description')->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down() {
        Schema::dropIfExists('batches');
    }
};

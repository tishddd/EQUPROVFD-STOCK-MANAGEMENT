<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('device_issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->string('issue_type'); // e.g., "Broken Screen", "Battery Issue"
            $table->text('description')->nullable(); // More details
            $table->enum('status', ['pending', 'repaired', 'irreparable'])->default('pending');
            $table->timestamp('reported_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_issues');
    }
};


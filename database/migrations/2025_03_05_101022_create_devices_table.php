
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id(); // Unique ID
            $table->string('item_name'); // POS, Printer, etc.
            $table->string('model_number'); // Device model
            $table->string('serial_number')->unique(); // Unique device identifier
            $table->enum('status', ['in_office', 'sold', 'damaged'])->default('in_office'); // Device status
            $table->unsignedBigInteger('office_id')->nullable(); // Office location (if in office)
            $table->unsignedBigInteger('employee_id')->nullable(); // Employee assigned to the device
            $table->timestamps(); // created_at & updated_at

            // Foreign keys
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
};





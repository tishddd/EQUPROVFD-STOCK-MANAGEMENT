
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Primary key (transaction ID)
            $table->foreignId('device_id')->constrained()->onDelete('cascade'); // Related device
            $table->unsignedBigInteger('employee_id')->nullable(); // Employee assigned to the device
            $table->string('region'); // Where it was sent
            $table->string('customer_tin')->nullable(); // Customer TIN (added column)
            $table->timestamp('date_sent'); // When sent
            $table->enum('status', ['sent', 'sold']); // Status of transaction
            $table->timestamps(); // created_at and updated_at

            // Foreign keys
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};


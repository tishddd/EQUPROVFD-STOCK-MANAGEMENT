<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id(); // Primary key (office ID)
            $table->string('name'); // Office name
            $table->string('region'); // Office region
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('offices');
    }
};

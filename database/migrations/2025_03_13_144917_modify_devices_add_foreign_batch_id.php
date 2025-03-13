<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('devices', function (Blueprint $table) {
            // Remove old VARCHAR batch_id
            $table->dropColumn('batch_id');

            // Add batch_id as a foreign key referencing batches.id
            $table->foreignId('batch_id')->nullable()->constrained('batches')->onDelete('set null');
        });
    }

    public function down() {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['batch_id']); // Remove foreign key constraint
            $table->dropColumn('batch_id'); // Remove the column

            // Restore the old VARCHAR column if rollback is needed
            $table->string('batch_id', 20)->default('');
        });
    }
};

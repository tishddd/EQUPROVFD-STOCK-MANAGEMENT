<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Delete all rows from devices table
        DB::table('devices')->delete();
    }

    public function down(): void
    {
        // No rollback for data deletion
    }
};

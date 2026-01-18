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
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            if (Schema::hasColumn('mata_pelajarans', 'guru_id')) {
                // Drop foreign key constraint first
                $table->dropForeign(['guru_id']);
                // Then drop the column
                $table->dropColumn('guru_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('set null');
        });
    }
};

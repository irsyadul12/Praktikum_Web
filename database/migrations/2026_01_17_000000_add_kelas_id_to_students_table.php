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
        Schema::table('students', function (Blueprint $table) {
            // Add kelas_id column as a foreign key
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null');

            // Drop the old 'kelas' string column if it exists
            if (Schema::hasColumn('students', 'kelas')) {
                $table->dropColumn('kelas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Re-add the 'kelas' string column
            $table->string('kelas')->nullable();

            // Drop the foreign key and the kelas_id column
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
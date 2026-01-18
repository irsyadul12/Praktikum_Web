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
            if (Schema::hasColumn('mata_pelajarans', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('mata_pelajarans', 'kelas_id')) {
                $table->dropForeign(['kelas_id']);
                $table->dropColumn('kelas_id');
            }

            // Add guru_id
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
            $table->dropColumn('guru_id');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained()->onDelete('cascade');
        });
    }
};

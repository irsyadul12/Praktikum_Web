<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if there are any existing Guru records
        if (Guru::count() === 0) {
            Guru::create([
                'nip' => '198001012005011001',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'mata_pelajaran' => 'Matematika',
            ]);

            Guru::create([
                'nip' => '198202022006021002',
                'nama' => 'Siti Aminah',
                'email' => 'siti.aminah@example.com',
                'mata_pelajaran' => 'Bahasa Indonesia',
            ]);

            Guru::create([
                'nip' => '197503032000031003',
                'nama' => 'Joko Susilo',
                'email' => 'joko.susilo@example.com',
                'mata_pelajaran' => 'Fisika',
            ]);
        }
    }
}

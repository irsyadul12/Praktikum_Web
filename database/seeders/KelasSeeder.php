<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Guru; // Assuming Kelas can be assigned a Guru

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if there are any existing Kelas records
        if (Kelas::count() === 0) {
            $guruIds = Guru::pluck('id')->toArray();
            $guruId = !empty($guruIds) ? $guruIds[array_rand($guruIds)] : null;
            
            Kelas::create([
                'nama' => '10 IPA 1',
                'kapasitas' => 30,
                'guru_id' => $guruId,
                'user_id' => 1, // Assuming a user with ID 1 exists
            ]);

            Kelas::create([
                'nama' => '10 IPA 2',
                'kapasitas' => 30,
                'guru_id' => $guruId,
                'user_id' => 1,
            ]);

            Kelas::create([
                'nama' => '10 IPS 1',
                'kapasitas' => 32,
                'guru_id' => $guruId,
                'user_id' => 1,
            ]);

            Kelas::create([
                'nama' => '11 IPA 1',
                'kapasitas' => 30,
                'guru_id' => $guruId,
                'user_id' => 1,
            ]);

            Kelas::create([
                'nama' => '12 IPA 1',
                'kapasitas' => 28,
                'guru_id' => $guruId,
                'user_id' => 1,
            ]);
        }
    }
}

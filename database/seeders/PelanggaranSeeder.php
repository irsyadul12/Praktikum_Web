<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Pelanggaran;

class PelanggaranSeeder extends Seeder
{
    public function run()
    {
        // Create sample students if none
        if (Student::count() == 0) {
            Student::insert([
                ['name' => 'Ahmad Fauzi', 'nis' => 'S001', 'email' => 'ahmad@example.com', 'kelas' => '10A', 'photo' => null, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Siti Nur', 'nis' => 'S002', 'email' => 'siti@example.com', 'kelas' => '10B', 'photo' => null, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Budi Santoso', 'nis' => 'S003', 'email' => 'budi@example.com', 'kelas' => '11A', 'photo' => null, 'created_at' => now(), 'updated_at' => now()]
            ]);
        }

        $students = Student::all();

        Pelanggaran::insert([
            ['student_id' => $students->random()->id, 'jenis' => 'pelanggaran', 'kategori' => 'non-akademik', 'poin' => -5, 'keterangan' => 'Terlambat datang', 'sanksi' => 'Skors ringan', 'tanggal' => now()->subDays(3)->format('Y-m-d'), 'created_at' => now(), 'updated_at' => now()],
            ['student_id' => $students->random()->id, 'jenis' => 'prestasi', 'kategori' => 'akademik', 'poin' => 10, 'keterangan' => 'Juara Kelas', 'sanksi' => null, 'tanggal' => now()->subDays(10)->format('Y-m-d'), 'created_at' => now(), 'updated_at' => now()],
            ['student_id' => $students->random()->id, 'jenis' => 'pelanggaran', 'kategori' => 'non-akademik', 'poin' => -10, 'keterangan' => 'Merusak fasilitas', 'sanksi' => 'Kerja sosial', 'tanggal' => now()->subDays(20)->format('Y-m-d'), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

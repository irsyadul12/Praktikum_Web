<?php

namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwalPelajaran = JamPelajaran::with(['mataPelajaran', 'kelas'])
            ->orderBy('waktu_mulai')
            ->get();

        $jadwalPerHari = $jadwalPelajaran->groupBy('hari');

        // Definisikan urutan hari yang benar
        $order = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        // Urutkan koleksi berdasarkan urutan hari yang ditentukan
        $jadwalPerHari = $jadwalPerHari->sortBy(function ($items, $key) use ($order) {
            return array_search($key, $order);
        });

        return view('jadwal.index', compact('jadwalPerHari'));
    }
}

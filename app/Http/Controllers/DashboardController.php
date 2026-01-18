<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalKelas = Kelas::count();
        $totalPelanggaran = Pelanggaran::where('jenis', 'pelanggaran')->whereMonth('tanggal', now()->month)->count();
        $totalPrestasi = Prestasi::whereMonth('tanggal', now()->month)->count();

        return view('dashboard', compact('totalStudents', 'totalKelas', 'totalPelanggaran', 'totalPrestasi'));
    }
}

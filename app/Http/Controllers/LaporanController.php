<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use App\Models\MataPelajaran;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function siswa(Request $request)
    {
        $query = Student::with('kelas');

        if ($q = $request->query('q')) {
            $query->where(function ($qbuilder) use ($q) {
                $qbuilder->where('name', 'like', "%$q%")
                    ->orWhere('nis', 'like', "%$q%");
            });
        }

        if ($kelasId = $request->query('kelas_id')) {
            $query->where('kelas_id', $kelasId);
        }

        $students = $query->orderBy('name')->get(); // Removed pagination for report, fetch all matching
        $allKelas = Kelas::all();

        return view('laporan.siswa', compact('students', 'allKelas'));
    }

    public function guru()
    {
        $gurus = Guru::with('mataPelajarans')->get();
        return view('laporan.guru', compact('gurus'));
    }

    public function kelas()
    {
        $kelas = Kelas::with(['students', 'guru'])->get(); // Eager load guru for wali kelas name
        return view('laporan.kelas', compact('kelas'));
    }

    public function absensi(Request $request)
    {
        $query = Absensi::with('student.kelas'); // Eager load student and their class

        if ($request->filled('kelas_id')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $absensis = $query->orderBy('tanggal', 'desc')->get();
        $allKelas = Kelas::all(); // Needed for the filter form

        return view('laporan.absensi', compact('absensis', 'allKelas'));
    }

    public function pelanggaran(Request $request)
    {
        $query = Pelanggaran::with(['student.kelas', 'creator']); // Eager load student (with class) and creator

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $pelanggarans = $query->orderBy('tanggal', 'desc')->get();
        $students = Student::orderBy('name')->get(); // Needed for the filter form

        return view('laporan.pelanggaran', compact('pelanggarans', 'students'));
    }

    public function prestasi(Request $request)
    {
        $query = Prestasi::with('student.kelas'); // Eager load student (with class)

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $prestasis = $query->orderBy('tanggal', 'desc')->get();
        $students = Student::orderBy('name')->get(); // Needed for the filter form

        return view('laporan.prestasi', compact('prestasis', 'students'));
    }

    public function mataPelajaran(Request $request)
    {
        $query = MataPelajaran::query();

        if ($request->filled('nama_mapel')) {
            $query->where('nama_mapel', 'like', '%' . $request->nama_mapel . '%');
        }

        $mataPelajarans = $query->orderBy('nama_mapel')->get();

        return view('laporan.mata_pelajaran', compact('mataPelajarans'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Kelas;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $kelasId = $request->input('kelas_id', Kelas::first()->id ?? null);
        $tanggal = $request->input('tanggal', Carbon::today()->format('Y-m-d'));

        $students = Student::where('kelas_id', $kelasId)->orderBy('name')->get();
        $kelas = Kelas::all();
        $absensi = Absensi::where('tanggal', $tanggal)
                            ->whereIn('student_id', $students->pluck('id'))
                            ->get()
                            ->keyBy('student_id');

        return view('absensi.index', compact('students', 'kelas', 'kelasId', 'tanggal', 'absensi'));
    }

    public function store(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $absensiData = $request->input('absensi', []);

        foreach ($absensiData as $studentId => $data) {
            Absensi::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'tanggal' => $tanggal,
                ],
                [
                    'status' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }
}

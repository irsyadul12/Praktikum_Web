<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JamPelajaran;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JadwalPelajaran::with(['kelas', 'mataPelajaran', 'guru', 'jamPelajaran']);

        if ($hari = $request->query('hari')) {
            $query->where('hari', $hari);
        }

        if ($kelasId = $request->query('kelas_id')) {
            $query->where('kelas_id', $kelasId);
        }

        $jadwals = $query->paginate(15)->withQueryString();
        $allKelas = Kelas::all();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];


        return view('jadwal.index', compact('jadwals', 'allKelas', 'hari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        $mataPelajaran = MataPelajaran::all();
        $gurus = Guru::all();
        $jamPelajaran = JamPelajaran::all();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('jadwal.create', compact('kelas', 'mataPelajaran', 'gurus', 'jamPelajaran', 'hari'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'guru_id' => 'required|exists:gurus,id',
            'jam_pelajaran_id' => 'required|exists:jam_pelajarans,id',
        ]);

        JadwalPelajaran::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal pelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalPelajaran $jadwal)
    {
        // Not used for now
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPelajaran $jadwal)
    {
        $kelas = Kelas::all();
        $mataPelajaran = MataPelajaran::all();
        $gurus = Guru::all();
        $jamPelajaran = JamPelajaran::all();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('jadwal.edit', compact('jadwal', 'kelas', 'mataPelajaran', 'gurus', 'jamPelajaran', 'hari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPelajaran $jadwal)
    {
        $request->validate([
            'hari' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'guru_id' => 'required|exists:gurus,id',
            'jam_pelajaran_id' => 'required|exists:jam_pelajarans,id',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPelajaran $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal pelajaran berhasil dihapus.');
    }
}

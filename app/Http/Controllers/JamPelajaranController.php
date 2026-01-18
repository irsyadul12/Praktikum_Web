<?php

namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use Illuminate\Http\Request;

class JamPelajaranController extends Controller
{
    public function index()
    {
        $jamPelajarans = JamPelajaran::all();
        return view('jam_pelajaran.index', compact('jamPelajarans'));
    }

    public function create()
    {
        return view('jam_pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        JamPelajaran::create($request->all());

        return redirect()->route('jam-pelajaran.index')
                         ->with('success','Jam pelajaran berhasil ditambahkan.');
    }

    public function edit(JamPelajaran $jamPelajaran)
    {
        return view('jam_pelajaran.edit', compact('jamPelajaran'));
    }

    public function update(Request $request, JamPelajaran $jamPelajaran)
    {
        $request->validate([
            'sesi' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        $jamPelajaran->update($request->all());

        return redirect()->route('jam-pelajaran.index')
                         ->with('success','Jam pelajaran berhasil diperbarui.');
    }

    public function destroy(JamPelajaran $jamPelajaran)
    {
        $jamPelajaran->delete();

        return redirect()->route('jam-pelajaran.index')
                         ->with('success','Jam pelajaran berhasil dihapus.');
    }
}

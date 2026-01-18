<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mataPelajarans = MataPelajaran::when($request->nama_mapel, function ($query, $nama_mapel) {
                return $query->where('nama_mapel', 'like', "%{$nama_mapel}%");
            })
            ->latest()
            ->paginate(10);

        return view('mata_pelajaran.index', compact('mataPelajarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('mata_pelajaran.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        MataPelajaran::create($request->only('nama_mapel'));

        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata Pelajaran created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        return view('mata_pelajaran.show', compact('mataPelajaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        $gurus = Guru::all();
        return view('mata_pelajaran.edit', compact('mataPelajaran', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        $mataPelajaran->update($request->only('nama_mapel'));

        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata Pelajaran updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();

        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata Pelajaran deleted successfully.');
    }
}

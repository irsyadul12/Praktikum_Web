<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::query();

        // Filter by class name
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->input('nama') . '%');
        }

        $kelas = $query->paginate(10);

        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('kelas.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'guru_id' => 'required|exists:gurus,id',
        ]);


        Kelas::create($data);

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        // Using route model binding, $kela is the instance of the Kelas model
        return view('kelas.show', compact('kela'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        $gurus = Guru::all();
        return view('kelas.edit', compact('kela', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'guru_id' => 'required|exists:gurus,id',
        ]);

        $kela->update($data);

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestasiRequest;
use App\Models\Prestasi;
use App\Models\Student;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Prestasi::with('student');

        if (request()->filled('student_id')) {
            $query->where('student_id', request('student_id'));
        }

        if (request()->filled('tingkat')) {
            $query->where('tingkat', request('tingkat'));
        }

        $prestasis = $query->latest()->paginate(15)->withQueryString();
        $students = Student::orderBy('name')->get();

        return view('prestasi.index', compact('prestasis', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('name')->get();
        return view('prestasi.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrestasiRequest $request)
    {
        $data = $request->validated();

        Prestasi::create($data);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        $prestasi->load('student');
        return view('prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        $students = Student::orderBy('name')->get();
        return view('prestasi.edit', compact('prestasi', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        $data = $request->validated();

        $prestasi->update($data);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}

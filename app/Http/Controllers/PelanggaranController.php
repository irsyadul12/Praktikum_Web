<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Student; // Import Student model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelanggaran::with(['student', 'creator']);

        if ($studentId = $request->query('student_id')) {
            $query->where('student_id', $studentId);
        }

        $pelanggarans = $query->latest()->paginate(15)->withQueryString();
        $students = Student::orderBy('name')->get();

        return view('pelanggarans.index', compact('pelanggarans', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all(); // Get all students for the dropdown
        return view('pelanggarans.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the new pelanggaran
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'jenis' => 'required|in:prestasi,pelanggaran',
            'kategori' => 'required|in:akademik,non-akademik',
            'poin' => 'required|integer',
            'keterangan' => 'nullable|string',
            'sanksi' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::id(); // Set created_by to the authenticated user's ID

        Pelanggaran::create($data);

        return redirect()->route('pelanggarans.index')
                         ->with('success', 'Pelanggaran created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggaran $pelanggaran)
    {
        $pelanggaran->load(['student', 'creator']); // Eager load student and creator
        return view('pelanggarans.show', compact('pelanggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggaran $pelanggaran)
    {
        $students = Student::all(); // Get all students for the dropdown
        return view('pelanggarans.edit', compact('pelanggaran', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        // Validate and update the pelanggaran
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'jenis' => 'required|in:prestasi,pelanggaran',
            'kategori' => 'required|in:akademik,non-akademik',
            'poin' => 'required|integer',
            'keterangan' => 'nullable|string',
            'sanksi' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ]);

        $data = $request->all();
        // created_by should not be updated here, only set on creation
        // If it needs to be updated, explicit logic should be added.

        $pelanggaran->update($data);

        return redirect()->route('pelanggarans.index')
                         ->with('success', 'Pelanggaran updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();

        return redirect()->route('pelanggarans.index')
                         ->with('success', 'Pelanggaran deleted successfully.');
    }
}

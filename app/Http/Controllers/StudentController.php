<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('kelas'); // Eager load the 'kelas' relationship

        if ($q = $request->query('q')) {
            $query->where(function ($qbuilder) use ($q) {
                $qbuilder->where('name', 'like', "%$q%")
                    ->orWhere('nis', 'like', "%$q%");
            });
        }

        if ($kelasId = $request->query('kelas_id')) { // Changed from 'kelas' to 'kelas_id'
            $query->where('kelas_id', $kelasId); // Filter by 'kelas_id'
        }

        $students = $query->orderBy('name')->paginate(15)->withQueryString();
        $allKelas = Kelas::all(); // Fetch all classes for the filter dropdown

        return view('students.index', compact('students', 'allKelas'));
    }

    private function ensureKelasExists()
    {
        $kelas = Kelas::all();
        if ($kelas->isEmpty()) {
            $user = User::firstOrCreate(
                ['email' => 'test@example.com'],
                ['name' => 'Test User', 'password' => Hash::make('password')]
            );

            $guru = Guru::firstOrCreate(
                ['nuptk' => '1234567890123456'],
                ['name' => 'Guru Contoh', 'email' => 'guru@example.com']
            );
            
            Kelas::create([
                'nama' => '10 IPA 1', 
                'kapasitas' => 30, 
                'guru_id' => $guru->id, 
                'user_id' => $user->id
            ]);
            
            $kelas = Kelas::all();
        }
        return $kelas;
    }

    public function create()
    {
        $kelas = $this->ensureKelasExists();
        return view('students.create', compact('kelas'));
    }

    public function store(StudentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('students', 'public');
            $data['photo'] = basename($path);
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student->load(['pelanggarans', 'prestasis']);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $kelas = $this->ensureKelasExists();
        return view('students.edit', compact('student', 'kelas'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            // delete old photo
            if ($student->photo) {
                Storage::disk('public')->delete('students/' . $student->photo);
            }
            $path = $request->file('photo')->store('students', 'public');
            $data['photo'] = basename($path);
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil diupdate.');
    }

    public function destroy(Student $student)
    {
        if ($student->photo) {
            Storage::disk('public')->delete('students/' . $student->photo);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

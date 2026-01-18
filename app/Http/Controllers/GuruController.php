<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuruRequest;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();

        if ($q = $request->query('q')) {
            $query->where('name', 'like', "%$q%")->orWhere('nuptk', 'like', "%$q%");
        }

        $gurus = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('gurus.index', compact('gurus'));
    }

    public function create()
    {
        return view('gurus.create');
    }

    public function store(GuruRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('gurus', 'public');
            $data['photo'] = basename($path);
        }

        Guru::create($data);

        return redirect()->route('gurus.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function show(Guru $guru)
    {
        return view('gurus.show', compact('guru'));
    }

    public function edit(Guru $guru)
    {
        return view('gurus.edit', compact('guru'));
    }

    public function update(GuruRequest $request, Guru $guru)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($guru->photo) {
                Storage::disk('public')->delete('gurus/' . $guru->photo);
            }
            $path = $request->file('photo')->store('gurus', 'public');
            $data['photo'] = basename($path);
        }

        $guru->update($data);

        return redirect()->route('gurus.index')->with('success', 'Guru berhasil diupdate.');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->photo) {
            Storage::disk('public')->delete('gurus/' . $guru->photo);
        }
        $guru->delete();
        return redirect()->route('gurus.index')->with('success', 'Guru berhasil dihapus.');
    }
}

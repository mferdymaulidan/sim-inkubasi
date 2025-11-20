<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->paginate(10);
        return view('kelas.index', compact('kelas'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);

        Kelas::create([
            'kelas' => $request->kelas,
        ]);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'kelas' => $request->kelas,
        ]);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', $e->getMessage());
        }
    }
}

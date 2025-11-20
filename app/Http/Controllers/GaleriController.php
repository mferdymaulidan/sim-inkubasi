<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriHarian;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $belum = GaleriHarian::whereDate('galeri_harian.created_at', now()->toDateString())->join('siswas', 'siswas.id', '=', 'galeri_harian.siswa_id')  
            ->select('siswas.id as siswa_id', 'siswas.nama as nama')
            ->distinct()
            ->pluck('siswa_id')
            ->toArray();
        $siswa = Siswa::whereNotIn('id', $belum)->get();
        $siswas=Siswa::with('galeri_harian')->whereIn('id', $belum)->get();
        return view('galeri.index', compact('siswas', 'siswa'));
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'galeri' => 'required|image|max:2048'
        ]);
        $report = $request->file('galeri');

        $storage = Storage::disk('public')->putFileAs('galeri_harian', $report, $report->hashName());
        GaleriHarian::create([
            'siswa_id' => $request->siswa_id,
            'foto' => $report->hashName()
        ]);
        return redirect()->route('galeri.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('galeri.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $galeri = GaleriHarian::findOrFail($id);
            Storage::disk('public')->delete('galeri_harian/' . $galeri->foto);
            $galeri->delete();
            return redirect()->route('galeri.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            return redirect()->route('galeri.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

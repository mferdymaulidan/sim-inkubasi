<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index():View
    {
        $siswa = DB::table('siswas')->where('siswas.deleted_at', null)
            ->leftjoin('kelassiswa', 'siswas.id', '=', 'kelassiswa.siswa_id')
            ->leftjoin('kelas', 'kelassiswa.kelas_id', '=', 'kelas.id')
            ->select('siswas.*', 'kelas.kelas as Kelas')
            ->latest()
            ->paginate(10);
        // $siswa = Siswa::latest()->paginate(10);
        return view('siswa.index', compact('siswa'));
    }

    public function create():View
    {
        return view('siswa.create');
    }

    public function store(Request $request) :RedirectResponse
    {
        try{
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:siswas,nik',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
        ]);
        Siswa::create($request->only('nama', 'nik', 'tempat_lahir', 'tanggal_lahir', 'alamat'));
        return redirect('/siswa')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect('/siswa')->with('error', $e->getMessage());
        }
    }

    public function show(string $id):View{
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    public function edit(string $id):View{
        $siswa = Siswa::findOrFail($id);
        $kelass = Kelas::all();
        $kelas = DB::table('kelassiswa')->where('siswa_id', $siswa->id)->first();
        return view('siswa.edit', compact('siswa', 'kelas', 'kelass'));
    }

    public function update(Request $request, string $id):RedirectResponse
    {
        try{
        $siswa = Siswa::findOrFail($id);
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:siswas,nik,'.$siswa->id,
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
        ]);
        $siswa->update($request->only('nama', 'nik', 'tempat_lahir', 'tanggal_lahir', 'alamat'));

        $exists = DB::table('kelassiswa')->where('siswa_id', $siswa->id)->exists();
        DB::table('kelassiswa')->updateOrInsert(
            ['siswa_id' => $siswa->id],
            ['kelas_id' => $request->kelas_id] + ($exists ? ['updated_at' => now()] : ['created_at' => now()])
        );
        return redirect('/siswa')->with('success', 'Data Berhasil Diupdate');
        } catch (\Exception $e) {
            return redirect('/siswa')->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id):RedirectResponse
    {
        try{
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect('/siswa')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect('/siswa')->with('error', $e->getMessage());
        }
    }
}

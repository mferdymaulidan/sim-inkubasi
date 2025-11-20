<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\FormatHelper;
use Illuminate\Support\Facades\Storage;

class PelanggaranController extends Controller
{
    public function index()
    {
        $pelanggaran=DB::table('pelanggaran')->join('kelassiswa','pelanggaran.kelassiswa_id','=','kelassiswa.id')->join('siswas','kelassiswa.siswa_id','=','siswas.id')->select('pelanggaran.*','siswas.nama as nama_pelanggar')->orderBy('pelanggaran.id','desc')->paginate(10);
        return view('pelanggaran.index', compact('pelanggaran'));
    }

    public function create()
    {
        $kelassiswa = DB::table('kelassiswa')->join('siswas', 'kelassiswa.siswa_id', '=', 'siswas.id')->select('kelassiswa.*', 'siswas.nama as nama_siswa')->get();
        return view('pelanggaran.create', compact('kelassiswa'));
    }

    public function store(Request $request)
    {
        try {
        $last=Pelanggaran::orderBy('id','desc')->first();
        
        if($last){
            $num=explode('/',$last->nomor_surat);
            $nomor=intval($num[0]);
        }else{
            $nomor=0;
        }
        $nomor_s=str_pad($nomor+1,3,'0',STR_PAD_LEFT);
        $romawi_bulan=FormatHelper::romawi(date('n'));
        $nofix=$nomor_s.'/INK/DO/'.$romawi_bulan.'/'.date('Y');

        $request->validate([
            'kelassiswa_id' => 'required|integer',
            'pelanggaran' => 'required|string',
            'hukuman' => 'required|string',
            'tanggal_keputusan' => 'required|date',
        ]);

        $data=[
            'nomor_surat' => $nofix,
            'kelassiswa_id' => $request->kelassiswa_id,
            'pelanggaran' => $request->pelanggaran,
            'hukuman' => $request->hukuman,
            'tanggal_keputusan' => $request->tanggal_keputusan,
        ];

        if($request->hasFile('bukti')){
            $request->validate([
                'bukti' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
            $bukti = $request->file('bukti');
            $storage = Storage::disk('public')->putFileAs('pelanggaran', $bukti, $bukti->hashName());
            $data['bukti'] = $bukti->hashName();
        }

        DB::table('pelanggaran')->insert($data);
        return redirect()->route('pelanggaran.index')->with('success', 'Data pelanggaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('pelanggaran.index')->with('error', 'Terjadi kesalahan saat menambahkan data pelanggaran.'. $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
        $pelanggaran = Pelanggaran::findOrFail($id);

        if ($pelanggaran->bukti) {
            Storage::disk('public')->delete('pelanggaran/' . $pelanggaran->bukti);
        }

        $pelanggaran->delete();

        return redirect()->route('pelanggaran.index')->with('success', 'Data pelanggaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pelanggaran.index')->with('error', 'Terjadi kesalahan saat menghapus data pelanggaran.'. $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $kelassiswa = DB::table('kelassiswa')->join('siswas', 'kelassiswa.siswa_id', '=', 'siswas.id')->select('kelassiswa.*', 'siswas.nama as nama_siswa')->get();
        return view('pelanggaran.edit', compact('pelanggaran', 'kelassiswa'));
    }

    public function update(Request $request, $id)
    {
        try {
        $pelanggaran = Pelanggaran::findOrFail($id);

        $request->validate([
            'kelassiswa_id' => 'required|integer',
            'pelanggaran' => 'required|string',
            'hukuman' => 'required|string',
            'tanggal_keputusan' => 'required|date',
        ]);

        $data = [
            'kelassiswa_id' => $request->kelassiswa_id,
            'pelanggaran' => $request->pelanggaran,
            'hukuman' => $request->hukuman,
            'tanggal_keputusan' => $request->tanggal_keputusan,
        ];

        if ($request->hasFile('bukti')) {
            $request->validate([
                'bukti' => 'mimes:jpg,jpeg,png|max:1024',
            ]);

            if ($pelanggaran->bukti) {
                Storage::disk('public')->delete('pelanggaran/' . $pelanggaran->bukti);
            }

            $bukti = $request->file('bukti');
            $storage = Storage::disk('public')->putFileAs('pelanggaran', $bukti, $bukti->hashName());
            $data['bukti'] = $bukti->hashName();
        }

        DB::table('pelanggaran')->where('id', $id)->update($data);

        return redirect()->route('pelanggaran.index')->with('success', 'Data pelanggaran berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('pelanggaran.index')->with('error', 'Terjadi kesalahan saat memperbarui data pelanggaran.'. $e->getMessage());
        }
    }
}

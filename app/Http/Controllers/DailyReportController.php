<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyReportController extends Controller
{
    public function index(){
        if (auth()->user()->hasRole('admin')){
        $data=DailyReport::with('siswas')->latest()->paginate(10);
        } elseif (auth()->user()->hasRole('siswa')) {
        $siswa_id = auth()->user()->siswa->id;
        $data=DailyReport::with('siswas')->where('siswas_id', $siswa_id)->latest()->paginate(10);
        }
        return view('dailyr.index',compact('data'));
    }

    public function create(){
        $data=Siswa::all();
        return view('dailyr.create',compact('data'));
    }

    public function store(Request $request) :RedirectResponse{
        try {
         $request->validate([
            'siswa_id'     => 'required|numeric',
            'report'         => 'required|mimes:pdf,png,jpg,jpeg|max:512'
        ]);

        $report = $request->file('report');
        // $report->storeAs('dailyreport', $report->hashName());

        $storage = Storage::disk('public')->putFileAs('dailyreport', $report, $report->hashName());

        $data = [
            'dokumen'       => $report->hashName(),
            'siswas_id'     => $request->siswa_id,
            'created_at'   => Carbon::now('Asia/Jakarta'),
        ];

        if($request->keterangan){
            $data['keterangan'] = $request->keterangan;
        }

        DailyReport::create($data);

        return redirect()->route('dailyr.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('dailyr.index')->with('error', 'Terjadi kesalahan saat menambahkan data laporan harian.'. $e->getMessage());
        }
    }

    public function destroy($id) :RedirectResponse{
        try {
        $kelas=DailyReport::findOrFail($id);
        Storage::disk('public')->delete('dailyreport/'.$kelas->dokumen);
        $kelas->delete();
        return redirect()->route('dailyr.index')->with('success','Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('dailyr.index')->with('error', 'Terjadi kesalahan saat menghapus data laporan harian.'. $e->getMessage());
        }
    }

    public function show($id){
        $data=DailyReport::with('siswas')->findOrFail($id);
        return view('dailyr.show',compact('data'));
    }

    public function showPdf($filename)
    {
        $path = storage_path('app/public/dailyreport/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $mime = mime_content_type($path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }

    public function edit($id){
        $data=DailyReport::findOrFail($id);
        return view('dailyr.edit',compact('data'));
    }

    public function update(Request $request, $id) :RedirectResponse{
        try {
        $dailyreport=DailyReport::findOrFail($id);
        $request->validate([
            'dokumen'         => 'mimes:pdf,png,jpg,jpeg|max:512'
        ]);

        if($request->hasFile('dokumen')){
            Storage::disk('public')->delete('dailyreport/'.$dailyreport->dokumen);
            $dokumen = $request->file('dokumen');
            $storage = Storage::disk('public')->putFileAs('dailyreport', $dokumen, $dokumen->hashName());
        }

        $data=[
            'updated_at'   => Carbon::now('Asia/Jakarta'),
        ];
        if($request->keterangan){
            $data['keterangan'] = $request->keterangan;
        }
        if($request->hasFile('dokumen')){
            $data['dokumen'] = $dokumen->hashName();
        }
        $dailyreport->update($data);
        return redirect()->route('dailyr.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } catch (\Exception $e) {
            return redirect()->route('dailyr.index')->with('error', 'Terjadi kesalahan saat memperbarui data laporan harian.'. $e->getMessage());
        }
    }
}
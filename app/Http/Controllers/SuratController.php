<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function generatePdf($id_pelanggaran)
    {
        $pelanggaran = DB::table('pelanggaran')
            ->join('kelassiswa', 'pelanggaran.kelassiswa_id', '=', 'kelassiswa.id')
            ->join('siswas', 'kelassiswa.siswa_id', '=', 'siswas.id')->join('kelas', 'kelassiswa.kelas_id', '=', 'kelas.id')
            ->select('pelanggaran.*', 'siswas.nama as nama_siswa', 'kelas.kelas as nama_kelas')
            ->where('pelanggaran.id', $id_pelanggaran)
            ->first();

        if (!$pelanggaran) {
            abort(404);
        }

        $pdf = PDF::loadView('surat.pelanggaran', compact('pelanggaran'))->setPaper([0, 0, 595, 935], 'portrait');
        return $pdf->stream('surat_pelanggaran_' . $id_pelanggaran . '.pdf');
    }
}

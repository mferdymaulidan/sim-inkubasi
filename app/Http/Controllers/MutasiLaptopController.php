<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiLaptop;
use App\Models\Laptop;

class MutasiLaptopController extends Controller
{
    public function index()
    {
        $mutasi=MutasiLaptop::with('laptop')->where('status', '!=', 'kembali')->latest()->get();
        $riwayat=MutasiLaptop::with('laptop')->where('status', 'kembali')->latest()->paginate(5);
        return view('mutasilaptop.index', compact('mutasi', 'riwayat'));
    }

    public function store(Request $request)
    {
        try{
        $laptop = Laptop::where('code', trim($request->code))->first();
        $mutasi=MutasiLaptop::where('laptop_id', $laptop->id)->where('status', 'ambil')->first();
        if($mutasi){
            $mutasi->status = 'kembali';
            $mutasi->save();
            return redirect()->back()->with('success', 'Laptop berhasil dikembalikan.');
        }else{
            $mutasi = new MutasiLaptop();
            $mutasi->laptop_id = $laptop->id;
            $mutasi->status = 'ambil';
            $mutasi->save();
            return redirect()->back()->with('success', 'Laptop berhasil diambil.');
        }
    }    catch(\Exception $e){
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}
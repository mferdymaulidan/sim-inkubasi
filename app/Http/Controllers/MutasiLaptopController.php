<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiLaptop;
use App\Models\User;
use App\Models\Laptop;

class MutasiLaptopController extends Controller
{
    public function index()
    {
        $mutasi = MutasiLaptop::with('laptop', 'user')->get();
        return view('mutasilaptop.index', compact('mutasi'));
    }

    public function create()
    {
        $users = User::all();
        $laptops = Laptop::all();
        return view('mutasilaptop.create', compact('users', 'laptops'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'laptop_id' => 'required|exists:laptops,id',
                'user_id' => 'required|exists:users,id'
            ]);
            MutasiLaptop::create($request->all());
            return redirect()->route('mutlaptop.index')->with('success', 'Mutasi laptop berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('mutlaptop.index')->with('error', 'Terjadi kesalahan saat menambahkan mutasi laptop.'. $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $mutasi = MutasiLaptop::findOrFail($id);
            $mutasi->delete();
            return redirect()->route('mutlaptop.index')->with('success', 'Mutasi laptop berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('mutlaptop.index')->with('error', 'Terjadi kesalahan saat menghapus mutasi laptop.'. $e->getMessage());
        }
    }

    public function update($id)
    {
        try{
            $mutasi = MutasiLaptop::findOrFail($id);
            $mutasi->status = 'kembali';
            $mutasi->save();
            return redirect()->route('mutlaptop.index')->with('success', 'Mutasi laptop berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('mutlaptop.index')->with('error', 'Terjadi kesalahan saat memperbarui mutasi laptop.'. $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::with('siswa')->latest()->paginate(10);
        return view('laptop.index', compact('laptops'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('laptop.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'siswa_id' => 'required|exists:siswas,id',
                'brand' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'aksesoris' => 'required|string|max:255',
                'gambar' => 'nullable|image|max:2048',
            ]);

            $laptop = new Laptop();
            $laptop->siswa_id = $request->siswa_id;
            $laptop->brand = $request->brand;
            $laptop->code = $request->code;
            $laptop->model = $request->model;
            $laptop->aksesoris = $request->aksesoris;

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('laptops', 'public');
                $laptop->gambar = $path;
            }

            $laptop->save();

            return redirect()->route('laptop.index')->with('success', 'Laptop berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan laptop: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $laptop = Laptop::findOrFail($id);
            if ($laptop->gambar) {
                Storage::disk('public')->delete($laptop->gambar);
            }
            $laptop->delete();
            
            return redirect()->route('laptop.index')->with('success', 'Laptop berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus laptop: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $laptop = Laptop::findOrFail($id);
        $siswa = Siswa::all();
        return view('laptop.edit', compact('laptop', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'siswa_id' => 'required|exists:siswas,id',
                'brand' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'aksesoris' => 'required|string|max:255',
                'gambar' => 'nullable|image|max:2048',
            ]);

            $laptop = Laptop::findOrFail($id);
            $laptop->siswa_id = $request->siswa_id;
            $laptop->brand = $request->brand;
            $laptop->code = $request->code;
            $laptop->model = $request->model;
            $laptop->aksesoris = $request->aksesoris;

            if ($request->hasFile('gambar')) {
                 if ($laptop->gambar) {
                Storage::disk('public')->delete($laptop->gambar);
                }
                $path = $request->file('gambar')->store('laptops', 'public');
                $laptop->gambar = $path;
            }

            $laptop->save();

            return redirect()->route('laptop.index')->with('success', 'Laptop berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('laptop.index')->with('error', 'Terjadi kesalahan saat memperbarui laptop: ' . $e->getMessage());
        }
    }
}

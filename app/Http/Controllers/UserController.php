<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->paginate(10);
        return view('user.index', compact('user'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('user.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'siswa_id' => 'nullable|exists:siswas,id',
        ]);

        if($request->password == $request->password_confirmation){
            User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'siswa_id' => $request->siswa_id,
            ]);
            return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
        } else {
            return back()->withErrors(['password' => 'Password confirmation does not match.'])->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $siswa = Siswa::all();
        return view('user.edit', compact('user', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'siswa_id' => 'nullable|exists:siswas,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            if($request->password == $request->password_confirmation){
                $user->password = bcrypt($request->password);
            } else {
                return back()->withErrors(['password' => 'Password confirmation does not match.'])->withInput();
            }
        }
        $user->siswa_id = $request->siswa_id;
        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully.');
    }
}
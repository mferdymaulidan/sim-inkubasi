<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $users = User::all();
        $role = DB::table('roles')->get();
        $roles = $users->map(function ($user) {
            return $user->getRoleNames();
        });
        return view('roles.index', compact('users', 'roles', 'role'));
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($request->user_id);
        $role = DB::table('roles')->where('id', $request->role_id)->first();
        if (!$role) {
            return redirect()->back()->withErrors(['role' => 'Role tidak ditemukan.']);
        }
        $user->assignRole([$role->name]);
        return redirect()->route('roles.index')->with('success', 'Role berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Terjadi kesalahan saat membuat role.'. $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
        $request->validate([
            'role_id' => 'required',
        ]);

        $user = User::find($id);
        $role = DB::table('roles')->where('id', $request->role_id)->first();
        $user->syncRoles([$role->name]);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Terjadi kesalahan saat memperbarui role.'. $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
        $user = User::find($id);
        $user->removeRole($user->getRoleNames());

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Terjadi kesalahan saat menghapus role.'. $e->getMessage());
        }
    }
}

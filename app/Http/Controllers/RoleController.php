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
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required',
        ]);

        $user = User::find($id);
        $role = DB::table('roles')->where('id', $request->role_id)->first();
        $user->syncRoles([$role->name]);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->removeRole($user->getRoleNames());

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->join('roles', 'users.idrole', '=', 'roles.id_role')
            ->select('users.*', 'roles.nama_role as role_name')
            ->get();

        $roles = DB::table('roles')->get();

        return view('user', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:45',
            'password' => 'required|string|max:100',
            'email' => 'required|email|max:60',
            'idrole' => 'required|exists:roles,id_role',
        ]);

        $userId = DB::table('users')->insertGetId([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'idrole' => $request->idrole,
            'STATUS' => 1, // Assuming 1 is for active status
        ]);

        return redirect()->route('users.index');
    }

    public function activate($id)
    {
        DB::table('users')->where('id_user', $id)->update(['STATUS' => 1]);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id_user', $id)->update(['STATUS' => 0]);

        return redirect()->route('users.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|string|max:45',
            'email' => 'required|email|max:60',
            'idrole' => 'required|exists:roles,id_role',
        ]);

        DB::table('users')->where('id_user', $id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'idrole' => $request->idrole,
            // Update other fields as needed
        ]);

        return redirect()->route('users.index');
    }
}

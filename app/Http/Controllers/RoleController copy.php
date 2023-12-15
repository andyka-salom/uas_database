<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')->get();
        return view('role', compact('roles'));
    }

    public function edit($id)
    {
        $role = DB::table('roles')->where('id_role', $id)->first();
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        DB::table('roles')
            ->where('id_role', $id)
            ->update([
                'nama_role' => $request->input('nama_role'),
                // Other fields to update
            ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function store(Request $request)
    {
        $newRoleID = DB::table('roles')->insertGetId([
            'nama_role' => $request->input('nama_role'),
            // Other fields to insert
            'STATUS' => 1, // Assuming newly added roles are initially active
        ]);

        return redirect()->route('roles.index')->with('success', 'Role added successfully');
    }

    public function destroy($id)
    {
        DB::table('roles')
            ->where('id_role', $id)
            ->update(['STATUS' => 0]); // Assuming STATUS field represents active/inactive

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
    public function activate($id)
    {
        DB::table('roles')
            ->where('id_role', $id)
            ->update(['STATUS' => 1]);

        return redirect()->route('roles.index')->with('success', 'Role activated successfully');
    }
}

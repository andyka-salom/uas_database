<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = DB::table('satuan')->get();
        return view('satuan', compact('satuan'));
    }

    public function edit($id)
    {
        $satuan = DB::table('satuan')->where('id_satuan', $id)->first();
        return view('satuan', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        DB::table('satuan')
            ->where('id_satuan', $id)
            ->update([
                'nama_satuan' => $request->input('nama_satuan'),
                // Other fields to update
            ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan updated successfully');
    }

    public function store(Request $request)
    {
        $newSatuanID = DB::table('satuan')->insertGetId([
            'nama_satuan' => $request->input('nama_satuan'),
            // Other fields to insert
            'STATUS' => 1, // Assuming newly added satuan are initially active
        ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan added successfully');
    }

    public function destroy($id)
    {
        DB::table('satuan')
            ->where('id_satuan', $id)
            ->update(['STATUS' => 0]); // Assuming STATUS field represents active/inactive

        return redirect()->route('satuan.index')->with('success', 'Satuan deleted successfully');
    }

    public function activate($id)
    {
        DB::table('satuan')
            ->where('id_satuan', $id)
            ->update(['STATUS' => 1]);

        return redirect()->route('satuan.index')->with('success', 'Satuan activated successfully');
    }
}

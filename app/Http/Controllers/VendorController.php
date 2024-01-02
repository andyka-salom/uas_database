<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = DB::table('vendor')->get();
        return view('admin.vendor', compact('vendors'));
    }

    public function edit($id)
    {
        $vendor = DB::table('vendor')->where('id_vendor', $id)->first();
        return view('admin.vendor', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        DB::table('vendor')
            ->where('id_vendor', $id)
            ->update([
                'nama_vendor' => $request->input('nama_vendor'),
            ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully');
    }

    public function store(Request $request)
    {
        $newVendorID = DB::table('vendor')->insertGetId([
            'nama_vendor' => $request->input('nama_vendor'),
            'STATUS' => 1,
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor added successfully');
    }

    public function destroy($id)
    {
        DB::table('vendor')
            ->where('id_vendor', $id)
            ->update(['STATUS' => 0]);

        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully');
    }

    public function activate($id)
    {
        DB::table('vendor')
            ->where('id_vendor', $id)
            ->update(['STATUS' => 1]);

        return redirect()->route('vendors.index')->with('success', 'Vendor activated successfully');
    }
}

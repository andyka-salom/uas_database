<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class MarginPenjualanController extends Controller
{
    public function index()
    {
        $marginPenjualans = DB::table('margin_penjualan')->get();

        return view('admin.marginpenjualan', compact('marginPenjualans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persen' => 'required|numeric',
        ]);
        $userId = Auth::id();
        DB::table('margin_penjualan')->insert([
            'persen' => $request->input('persen'),
            'STATUS' => 1,
            'iduser' => $userId,
        ]);

        return redirect()->route('margin_penjualan.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'persen' => 'required|numeric',
        ]);

        DB::table('margin_penjualan')->where('idmargin_penjualan', $id)->update([
            'persen' => $request->input('persen'),
        ]);

        return redirect()->route('margin_penjualan.index');
    }

    public function activate($id)
    {
        DB::table('margin_penjualan')->where('idmargin_penjualan', $id)->update([
            'STATUS' => 1,
        ]);

        return redirect()->route('margin_penjualan.index');
    }

    public function destroy($id)
    {
        DB::table('margin_penjualan')->where('idmargin_penjualan', $id)->update([
            'STATUS' => 1,
        ]);

        return redirect()->route('margin_penjualan.index');
    }
}

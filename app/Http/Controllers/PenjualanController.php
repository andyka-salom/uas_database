<?php
// app/Http/Controllers/PemesananController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class PemesananController extends Controller
{
    public function searchProduct(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $products = DB::table('barang')
            ->where('nama', 'like', '%' . $searchTerm . '%')
            ->get();

        return view('kasir.penjualan', compact('products'));
    }

    public function tambahPenjualan(Request $request)
    {
        $iduser = $request->input('iduser');
        $idmargin_penjualan = $request->input('idmargin_penjualan');
        $subtotal_nilai = $request->input('subtotal_nilai');
        $ppn = $request->input('ppn');
        $total_nilai = $request->input('total_nilai');
        $created_at = $request->input('created_at');

        DB::statement("CALL tambah_penjualan(?, ?, ?, ?, ?, ?)", [
            $iduser,
            $idmargin_penjualan,
            $subtotal_nilai,
            $ppn,
            $total_nilai,
            $created_at,
        ]);

        return response()->json(['message' => 'Penjualan berhasil ditambahkan.']);
    }
}

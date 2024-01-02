<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index()
    {
        // Fetch sales details from the view
        $salesDetails = DB::table('ViewSalesDetails')->get();

        // Fetch available barangs for dropdown
        $barangs = DB::table('barang')->get();

        // Fetch available margin_penjualans for dropdown
        $marginPenjualans = DB::table('margin_penjualan')->get();

        return view('kasir.pemesanan', compact('salesDetails', 'barangs', 'marginPenjualans'));
    }

    public function tambahPenjualan(Request $request)
    {
        // Extract form inputs
        $idbarang = $request->input('idbarang');
        $quantity = $request->input('quantity');
        $ppn = $request->input('ppn');
        $marginPenjualan = $request->input('marginPenjualan');
        $userId = Auth::id();
        // Fetch hargaSatuan and margin_penjualan from the database based on selected barang
        $barang = DB::table('barang')->where('id_barang', $idbarang)->first();
        $hargaSatuan = $barang->harga;

        // Calculate subtotal, subtotalNilai, and totalNilai
        $subtotal = $quantity * $hargaSatuan;
        $subtotalNilai = $subtotal * ($ppn / 100);
        $totalNilai = $subtotalNilai + ($subtotalNilai * $marginPenjualan / 100);

        // Call the stored procedure to insert data into penjualan and detail_penjualan tables
        DB::select('CALL tambah_penjualan(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            now(),
            $subtotal,
            $ppn,
            $totalNilai,
            $userId,
            $marginPenjualan,
            $hargaSatuan,
            $quantity,
            $subtotal,
            $idbarang,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Penjualan berhasil ditambahkan.');
    }
}

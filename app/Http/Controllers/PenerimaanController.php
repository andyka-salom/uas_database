<?php
// app/Http/Controllers/PenerimaanController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index()
    {
        // Fetch data from the view
        $penerimaanDetails = DB::select("SELECT * FROM penerimaan_details");

        return view('admin.penerimaan', compact('penerimaanDetails'));
    }

    public function tambahPenerimaan(Request $request)
    {
        $userId = Auth::id();
        $request->validate([
            'idpengadaan' => 'required',
            'status' => 'required',
            'barang_idbarang' => 'required',
            'jumlah_terima' => 'required',
            'harga_satuan_terima' => 'required',
        ]);

        // Call the stored procedure
        DB::select("CALL tambah_penerimaan(?, ?, ?, ?, ?, ?)", [
            $request->idpengadaan,
            $request->status,
            $userId,
            $request->barang_idbarang,
            $request->jumlah_terima,
            $request->harga_satuan_terima,
        ]);

        // You can add a success message if needed
        return response()->json(['message' => 'Penerimaan added successfully']);
    }
}

<?php
// app/Http/Controllers/PengadaanController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        $pengadaanDetails = DB::table('ViewProcurementDetails')->get();
    
        $barangs = DB::table('barang')->get();
    
        $vendors = DB::table('vendor')->get();
    
        return view('admin.pengadaan', [
            'pengadaanDetails' => $pengadaanDetails,
            'barangs' => $barangs,
            'vendors' => $vendors,
        ]);
    }
    
    public function calculateTotalPengadaan()
    {
        $totalPengadaan = DB::select('SELECT CalculateSubtotalPengadaan(1) AS totalPengadaan')[0]->totalPengadaan;

        return response()->json(['totalPengadaan' => $totalPengadaan]);
    }

 
public function createPengadaan(Request $request)
{
    $userId = Auth::id();
    $pengadaanId = DB::table('pengadaan')->insertGetId([
        'TIMESTAMP' => now(),
        'user_id' =>  $userId,
        'vendor_idvendor' => $request->input('vendor_idvendor'),
        'subtotal_nilai' => $request->input('sub_total'),
        'ppn' => $request->input('ppn'),
        'total_nilai' => $request->input('total_nilai'),
        'STATUS' => 0,
    ]);

    DB::table('detail_pengadaan')->insert([
        'harga_satuan' => $request->input('harga_satuan'),
        'jumlah' => $request->input('jumlah'),
        'sub_total' => $request->input('sub_total'),
        'idbarang' => $request->input('idbarang'),
        'idpengadaan' => $pengadaanId,
    ]);

    return response()->json(['success' => true]);
}
}

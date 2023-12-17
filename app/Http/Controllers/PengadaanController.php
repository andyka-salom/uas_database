<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        // Fetch pengadaan details with JOIN
        $pengadaanDetails = DB::table('ViewProcurementDetails')->get();

        // Fetch vendor and barang data for the form
        $vendors = DB::table('vendor')->get();
        $barangs = DB::table('barang')->get();

        return view('pengadaan', compact('pengadaanDetails', 'vendors', 'barangs'));
    }


    public function tambahPengadaan(Request $request)
    {
        // Validasi request jika diperlukan
    
        // Ambil data dari request
        $vendorId = $request->input('vendor');
        $barangId = $request->input('barang');
        $jumlah = $request->input('jumlah');
        $hargaSatuan = Barang::find($barangId)->harga; // Ambil harga dari tabel barang
    
        // Hitung subtotal
        $subTotal = $jumlah * $hargaSatuan;
    
        // Simpan ke tabel pengadaan
        $pengadaan = new Pengadaan();
        $pengadaan->user_id_user = auth()->user()->id;
        $pengadaan->STATUS = 0; // Belum Selesai
        $pengadaan->vendor_idvendor = $vendorId;
        $pengadaan->subtotal_nilai = $subTotal;
        $pengadaan->save();
    
        // Simpan ke tabel detail_pengadaan
        $detailPengadaan = new DetailPengadaan();
        $detailPengadaan->harga_satuan = $hargaSatuan;
        $detailPengadaan->jumlah = $jumlah;
        $detailPengadaan->sub_total = $subTotal;
        $detailPengadaan->idbarang = $barangId;
        $detailPengadaan->idpengadaan = $pengadaan->id_pengadaan;
        $detailPengadaan->save();
    
        // TODO: Refresh atau perbarui data daftar pengadaan setelah penambahan
    
        return response()->json(['message' => 'Pengadaan berhasil ditambahkan'], 200);
    }
}

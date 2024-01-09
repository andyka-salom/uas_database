<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReturnController extends Controller
{
    public function index()
    {
      
        $retur = DB::select("SELECT * FROM ViewReturnDetails");
        $penerimaans = DB::table('penerimaan')->get();
        $users = DB::table('users')->get();
        $barangs = DB::table('barang')->get();
        return view('kasir.return', compact('retur','users','barangs','penerimaans'));
    }

    public function addReturn(Request $request)
    {
        $userId = Auth::id();
     
        $request->validate([
            'penerimaan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer',
            'alasan' => 'required|string|max:200',
        ]);

        DB::select('CALL tambah_retur(?, ?, ?, ?, ?)', [
            $request->input('penerimaan_id'),
            $userId,
            $request->input('barang_id'),
            $request->input('jumlah'),
            $request->input('alasan'),
        ]);

        return response()->json(['message' => 'Return added successfully']);
    }
}

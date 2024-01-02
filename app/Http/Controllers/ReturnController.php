<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReturnController extends Controller
{
    public function index()
    {
        // Fetch returns data using the ViewReturnDetails view
        $retur = DB::select("SELECT * FROM ViewReturnDetails");

        return view('kasir.return', compact('retur'));
    }

    public function addReturn(Request $request)
    {
        $userId = Auth::id();
        // Validate the incoming request data
        $request->validate([
            'penerimaan_id' => 'required|integer',
           
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer',
            'alasan' => 'required|string|max:200',
        ]);

        // Call the stored procedure to add return
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

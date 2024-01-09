<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = DB::table('penerimaan')
            ->join('users', 'penerimaan.iduser', '=', 'users.id')
            ->select('penerimaan.*', 'users.username as user_username')
            ->get();

        return view('admin.penerimaan', compact('receipts'));
    }

    public function create()
    {
        return view('admin.penerimaan');
    }

    public function store(Request $request)
    {

        DB::table('penerimaan')->insert([
            'created_at' => $request->input('created_at'),
            'status' => $request->input('status'),
            'idpengadaan' => $request->input('idpengadaan'),
            'iduser' => $request->input('iduser'),
          
        ]);

        
        return redirect()->route('receipt.index')->with('success', 'Receipt added successfully');
    }

 
}

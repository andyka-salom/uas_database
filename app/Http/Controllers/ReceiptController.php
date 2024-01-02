<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index()
    {
        // Retrieve list of receipt transactions using Query Builder
        $receipts = DB::table('penerimaan')
            ->join('users', 'penerimaan.iduser', '=', 'users.id')
            ->select('penerimaan.*', 'users.username as user_username')
            ->get();

        return view('admin.penerimaan', compact('receipts'));
    }

    public function create()
    {
        // Retrieve data needed for the "Add Receipt" form, e.g., pengadaan, users, etc.

        return view('admin.penerimaan');
    }

    public function store(Request $request)
    {
        // Validate the request data (add validation rules as needed)

        // Insert the new receipt into the database using Query Builder
        DB::table('penerimaan')->insert([
            'created_at' => $request->input('created_at'),
            'status' => $request->input('status'),
            'idpengadaan' => $request->input('idpengadaan'),
            'iduser' => $request->input('iduser'),
            // Add other fields as needed
        ]);

        // Redirect to the receipt list or a success page
        return redirect()->route('receipt.index')->with('success', 'Receipt added successfully');
    }

    // Add other methods as needed (e.g., show, edit, update, delete)
}

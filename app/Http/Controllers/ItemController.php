<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $items = DB::table('barang')
            ->join('satuan', 'barang.id_satuan', '=', 'satuan.id_satuan')
            ->select('barang.*', 'satuan.nama_satuan as satuan_name')
            ->get();

        $units = DB::table('satuan')->get();

        return view('barang', compact('items', 'units'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis' => 'required|string|max:1',
            'nama' => 'required|string|max:45',
            'id_satuan' => 'required|exists:satuan,id_satuan',
            'harga' => 'required|integer',
        ]);

        $itemId = DB::table('barang')->insertGetId([
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'id_satuan' => $request->id_satuan,
            'harga' => $request->harga,
            'STATUS' => 1, // Assuming 1 is for active status
        ]);

        return redirect()->route('items.index');
    }

    public function activate($id)
    {
        DB::table('barang')->where('id_barang', $id)->update(['STATUS' => 1]);

        return redirect()->route('items.index');
    }

    public function destroy($id)
    {
        DB::table('barang')->where('id_barang', $id)->update(['STATUS' => 0]);

        return redirect()->route('items.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:45',
            // Add other validation rules as needed
        ]);

        DB::table('barang')->where('id_barang', $id)->update([
            'nama' => $request->nama,
            // Update other fields as needed
        ]);

        return redirect()->route('items.index');
    }
}

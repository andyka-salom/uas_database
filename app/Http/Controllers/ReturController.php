<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function index()
    {
        $returns = DB::table('ViewReturnDetails')->get();

        return response()->json($returns);
    }

    public function show($id)
    {
        $returnDetails = DB::table('ViewReturnDetails')->where('idretur', $id)->get();

        return response()->json($returnDetails);
    }
}

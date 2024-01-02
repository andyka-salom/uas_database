<?php
// KartuStokController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KartuStokController extends Controller
{
        public function index()
        {
            $kartuStok = DB::table('kartustok')->get();
    
            return view('admin.kartustok', compact('kartuStok'));
        }
}

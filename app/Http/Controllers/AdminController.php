<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index()
    {
        // Retrieve user data
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $user->totalSales = $this->calculateTotalSales($user->id);
        }
        // Retrieve pengadaan data with subtotal using the CalculateSubtotalPengadaan function
        $pengadaans = DB::table('pengadaan')
            ->select('id_pengadaan', DB::raw('CalculateSubtotalPengadaan(id_pengadaan) as subtotal_pengadaan'))
            ->get();

        return view('admin.dashboard', compact('users', 'pengadaans'));
    }
    public function calculateTotalSales($salesID)
    {
        $totalSales = DB::select("SELECT CalculateTotalSales($salesID) as total_sales")[0]->total_sales;
        return $totalSales;
    }
    public function generateDailySalesReport(Request $request)
    {
        $date = $request->input('date');

        // Use the GenerateDailySalesReport stored procedure
        $results = DB::select('CALL GenerateDailySalesReport(?)', [$date]);

        return response()->json($results);
    }
    public function getProcurementSummary(Request $request)
    {
        $procurementID = $request->input('procurementID');

        // Use the GetProcurementSummary stored procedure
        $result = DB::selectOne('CALL GetProcurementSummary(?)', [$procurementID]);

        return response()->json($result);
    }
}

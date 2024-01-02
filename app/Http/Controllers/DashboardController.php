<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan data user dan total sales
        $users = DB::table('users')->get(); 

        // Menghitung total sales untuk setiap user
        foreach ($users as $user) {
            $user->totalSales = $this->calculateTotalSales($user->id_user);
        }

        return view('welcome', compact('users'));
    }

    public function calculateTotalSales($salesID)
    {
        $totalSales = DB::select("SELECT CalculateTotalSales($salesID) as total_sales")[0]->total_sales;
        return $totalSales;
    }
}

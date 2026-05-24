<?php

namespace App\Http\Controllers;

use App\Models\Diesel;

class UserDashboardController extends Controller
{
    public function index()
    {
        $diesel_total_liters = Diesel::sum('deisel_total_liters');

        return view('User.user_dashboard', compact('diesel_total_liters'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Diesel;


class AdminDashboardController extends Controller
{
    public function adminDashboard()
    {
        $dieselsCount = Diesel::count();
//        $itemsCount = Item::count();
//        $ordersCount = Order::count();
//        $completedOrdersCount = Order::whereIn('order_status', ['completed', 'Complete', 'Completed', 'complete'])->count();

        return view('admin.admin_dashboard', compact(
            'dieselsCount',
//            'itemsCount',
//            'ordersCount',
//            'completedOrdersCount'
        ));
    }
}

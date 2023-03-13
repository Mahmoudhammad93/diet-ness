<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        Carbon::setWeekStartsAt(Carbon::SATURDAY);
        Carbon::setWeekEndsAt(Carbon::FRIDAY);
    }

    public function index()
    {
        $title = trans('admin.Dashboard');

        $todaySales = Subscription::whereDate('created_at', date('Y-m-d'))->sum('total');
        $weekSales = Subscription::whereBetween('created_at', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()])->sum('total');
        $monthSales = Subscription::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])->sum('total');
        $allSales = Subscription::sum('total');

        $todayOrders = Subscription::whereDate('created_at', date('Y-m-d'))->count();
        $weekOrders = Subscription::whereBetween('created_at', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()])->count();
        $monthOrders = Subscription::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])->count();
        $allOrders = Subscription::count();

        return view('admin.dashboard.new', get_defined_vars());
    }
}

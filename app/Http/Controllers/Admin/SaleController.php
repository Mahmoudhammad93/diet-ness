<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function __construct()
    {
        Carbon::setWeekStartsAt(Carbon::SATURDAY);
        Carbon::setWeekEndsAt(Carbon::FRIDAY);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sales.index',[
            'title'=>trans('admin.All Sales'),
            'sales'=>Subscription::latest()->paginate(50)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function today()
    {
        return view('admin.sales.index',[
            'title'=>trans('admin.Sales Today'),
            'sales'=>Subscription::latest()->whereDate('created_at', date('Y-m-d'))->paginate(50)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function week()
    {
        return view('admin.sales.index',[
            'title'=>trans('admin.Sales Week'),
            'sales'=>Subscription::whereBetween('created_at', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()])->latest()->paginate(50)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function month()
    {
        return view('admin.sales.index',[
            'title'=>trans('admin.Sales Month'),
            'sales'=>Subscription::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])->latest()->paginate(50)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function year()
    {
        return view('admin.sales.index',[
            'title'=>trans('admin.Yearly Sales'),
            'sales'=>Subscription::latest()->whereYear('created_at', date('Y'))->paginate(50)
        ]);
    }

}

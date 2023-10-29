<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
       $total_order = Order::all()->count();
       $total_pending_order = Order::where('status','=','pending')->count();
       $total_complete_order = Order::where('status','=','completed')->count();
       $data = [
        'total_order'=>$total_order,
        'total_pending_order'=>$total_pending_order,
        'total_complete_order'=>$total_complete_order
    ];
        return view('AdminSite.Pages.Dashboard.dashboard',['data'=>$data ]);
    }
}

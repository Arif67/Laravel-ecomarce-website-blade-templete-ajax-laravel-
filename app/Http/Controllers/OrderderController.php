<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

/**
 * Summary of OrderderController
 */
class OrderderController extends Controller
{
    public function index(){
      $order= Order::with(['orderDetails','user'])->get();
      return view('AdminSite.Pages.OrderPage.order',['data'=>$order]);

    }
}

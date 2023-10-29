<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        if(Auth::id()){
          $usertype=  Auth::user()->role;

            if($usertype=='user'){
              return view('UserSite.pages.home');
          
            }else if($usertype == "admin"){
             
              return view('AdminSite.admin');
              
            }else{
                return back();
            }

        }
     
    }
}

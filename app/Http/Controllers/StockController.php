<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index(){
        $stock = Stock::find(1); // Assuming you have a stock entry with ID 1
        $product = $stock->product; // Access the associated product
        
        
        $stocks = Stock::with('product')->get();
        foreach ($stocks as $stock) {
            $product = $stock->product; // Access the associated product for each stock entry
        }
    }
    
}

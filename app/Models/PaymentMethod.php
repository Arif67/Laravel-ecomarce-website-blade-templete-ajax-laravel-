<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

      protected $fillable = [
        'payment',
        'order_id',
        'total_price',
        'transection_id'
    ]; 
    public function order(){
      return $this->belongsTo(Order::class);
    }
}

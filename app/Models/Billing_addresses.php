<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing_addresses extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'first_name',
        'last_name',
        'email',
        'mobile_no',
        'address_line1',
        'address_line2',
        'country',
        'city',
        'state',
        'zipcode'   
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    
}

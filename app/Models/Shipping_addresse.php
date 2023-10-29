<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_addresse extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'sfirst_name',
        'slast_name',
        'email',
        'mobile_no',
        'address_line1',
        'address_line2',
        'country',
        'city',
        'state',
        'postal_code'   
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }
}

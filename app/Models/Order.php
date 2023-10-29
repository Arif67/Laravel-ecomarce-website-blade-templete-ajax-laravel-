<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'guest_token'
        
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function guest()
    {
        return $this->hasOne(Guest::class, 'guest_token', 'guest_token');
    }
    public function billingAddress(){
        return $this->hasOne(Billing_addresses::class);
    }
    public function shippingAddress(){
        return $this->hasOne(Shipping_addresse::class);
    }
    public function paymentMethod(){
        return $this->hasOne(PaymentMethod::class);
    }
   


}

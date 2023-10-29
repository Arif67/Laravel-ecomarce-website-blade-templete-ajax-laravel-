<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProudctCart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity','name','price','guest_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
   
}

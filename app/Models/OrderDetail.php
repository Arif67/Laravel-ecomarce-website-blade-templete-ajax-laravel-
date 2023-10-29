<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of OrderDetail
 */
class OrderDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
       'order_id',
       'product_id',
       'name',
       'qty',
       'total_price',
       
        
    ];

    /**
     * Summary of order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    /**
     * Summary of product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

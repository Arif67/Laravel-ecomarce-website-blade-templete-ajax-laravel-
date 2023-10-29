<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    use HasFactory;
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        "category_id",
        'subcategory_id',
        'brand_id',
        'product_name',
        'status',
        'image'
    ];
    /**
     * Summary of stock
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
 
    /**
     * Summary of discounts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
    /**
     * Summary of brand
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Summary of subcategory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    /**
     * Summary of productCart
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productCart()
    {
        return $this->hasMany(ProudctCart::class);
    }
    /**
     * Summary of orderDetails
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

       
       

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'guest_token',
        'name',
        'mobile',
        'email',
        'address'
        
    ];

    public function order()
        {
            return $this->belongsTo(Order::class, 'guest_token', 'guest_token');
        }

}

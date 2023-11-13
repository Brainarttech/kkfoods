<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }



    use HasFactory;

    public $table="orders_item";
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'zone',
    ];
}

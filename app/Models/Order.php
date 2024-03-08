<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_date',
        'order_num',
        'customer_id',
        'status',
        'product_id',
        'order_quantity'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class,);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_details','order_id','product_id')->withPivot('order_quantity');
    }
}

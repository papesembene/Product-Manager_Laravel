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
        'status'
    ];
    public function Customers()
    {
        return $this->belongsTo(Customer::class);
    }
    public function Order_details()
    {
        return $this->hasMany(OrderDetail::class,);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'oder_details','order_id','product_id')->withPivot('order_quantity');
    }
}

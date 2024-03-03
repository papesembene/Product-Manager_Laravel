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
    ];
    public function Customers()
    {
        return $this->belongsTo(Customer::class);
    }
    public function Order_details()
    {
        return $this->hasMany(OrderDetail::class,);
    }
}

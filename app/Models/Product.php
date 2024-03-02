<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'category_id',
    ];
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public  function Orders(){
        return $this->belongsToMany(Order::class);
    }



}

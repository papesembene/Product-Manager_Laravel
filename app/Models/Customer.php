<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'adress',
        'number',
        'genre',

    ];
    public function Orders()
    {
        return $this->hasMany(Order::class);
    }
}

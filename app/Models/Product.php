<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $fillable = [
        'name', 'price', 'units', 'description', 'image'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

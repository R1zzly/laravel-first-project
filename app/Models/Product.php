<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

protected $fillable = [
    'name',
    'category_id',
    'price',
    'count',
];

public function category(){
    return $this->belongsTo(Category::class);
}

public function orders()
{
    return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
}

public function reviews()
{
    return $this->hasMany(Review::class);
}
}

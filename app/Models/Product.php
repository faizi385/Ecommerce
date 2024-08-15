<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

   // app/Models/Product.php

protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'image',
    'category_id',
    'featured',
];


    // Define the relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Define the relationship to Tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

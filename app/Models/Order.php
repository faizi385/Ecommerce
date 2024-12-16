<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','name', 'total', 'status', 'address', 'city', 'country', 'payment_method', 'notes', 'product_id', 'price'
    ];

    // Define the relationship with OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Define the relationship with User (if needed)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

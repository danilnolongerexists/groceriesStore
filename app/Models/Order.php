<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'created_at',
        'address',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function items()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_receipt')
                    ->withPivot('count');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}

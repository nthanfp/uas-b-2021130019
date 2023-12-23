<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    /**
     * Define a one-to-many relationship with OrderItem model
     */
    public function orderItems()
    {
        // return $this->hasMany(OrderItem::class)->withP;
        return $this->belongsToMany(Item::class, 'order_items')->withPivot(['quantity']);
    }
}

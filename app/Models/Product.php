<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image'
    ];

    // Tambahkan relasi dengan OrderItem
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Tambahkan relasi dengan Rating
    public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function averageRating()
{
    return $this->ratings()->avg('rating') ?? 0;
}

// Add this method to get total sales
public function getTotalSoldAttribute()
{
    return $this->orderItems()
        ->whereHas('order', function($query) {
            $query->where('status', 'completed');
        })
        ->sum('quantity');
}
}

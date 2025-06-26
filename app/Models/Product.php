<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'sku',
        'price',
        'in_stock',
        'min_qty',
        'weight',
        'volume'
    ];

    protected static function booted() {
        static::creating(function ($product) {
            if (!$product->id) {
                $product->id = (string) Str::uuid();
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id', 'type', 'quantity', 'stock_before', 'stock_after',
        'reference_type', 'reference_id', 'description', 'created_by',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeOfProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}

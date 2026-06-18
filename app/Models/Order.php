<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'customer_name', 'customer_phone', 'customer_address',
        'customer_email', 'notes', 'stock_reduced', 'total_amount', 'status',
        'confirmed_at', 'shipped_at', 'completed_at'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'stock_reduced' => 'boolean',
        'confirmed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public const STATUS_LABELS = [
        'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
        'diproses' => 'Diproses',
        'dikirim' => 'Dikirim',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    public const STATUS_COLORS = [
        'menunggu_konfirmasi' => 'yellow',
        'diproses' => 'blue',
        'dikirim' => 'indigo',
        'selesai' => 'green',
        'dibatalkan' => 'red',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'gray';
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public static function generateOrderNumber(): string
    {
        $prefix = 'MST';
        $date = now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', today())->count() + 1;
        return $prefix . $date . str_pad($lastOrder, 4, '0', STR_PAD_LEFT);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'status',
        'total_price',
        // 'shipping_cost',
        'shipping_address',
        'payment_method',
        'payment_status',
        'shipping_status',
    ];

    protected $casts = [
        'shipping_cost' => 'float',
        'total_price' => 'float',
    ];


    // Menambahkan observer untuk memeriksa status pembayaran dan pembatalan pengiriman
    protected static function booted()
    {
        static::updating(function ($order) {
            // Cek jika payment_status diubah menjadi "failed"
            if ($order->isDirty('payment_status') && $order->payment_status === 'failed') {
                // Ubah shipping_status menjadi 'batal' jika payment_status gagal
                $order->shipping_status = 'batal';
            }
        });
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}

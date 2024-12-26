<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    // Fungsi untuk menghitung ongkos kirim berdasarkan berat produk
    public function hitungOngkosKirim()
    {
        // Tarif ongkos kirim per kg (misalnya, 5.000)
        // $tarifPerKg = 5000;

        // // Ambil berat produk
        // $beratProduk = $this->product->weight; // Pastikan kolom weight ada pada tabel produk
        // $quantity = $this->quantity;

        // return $tarifPerKg * $beratProduk * $quantity;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

        protected $table = 'cart';

        protected $fillable = [
            'quantity',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function product()
        {
            return $this->belongsTo(Product::class);
        }
}

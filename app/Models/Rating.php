<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'rating'];

    // Validasi nilai rating
    public static function boot()
    {
        parent::boot();

        static::creating(function ($rating) {
            if ($rating->rating < 1 || $rating->rating > 5) {
                throw new \Exception('Rating must be between 1 and 5');
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

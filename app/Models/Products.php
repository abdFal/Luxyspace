<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'price', 'description', 'Qty'
    ];

    // protected $guarded = []; for all data could be accessed

    /**
     * Get all of the comments for the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(ProductsGallery::class, 'product_id', 'id');
    }

    /**
     * Get the user associated with the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, 'foreign_key', 'local_key');
    }

    /**
     * Get the user that owns the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction_item(): BelongsTo
    {
        return $this->belongsTo(transaction_item::class, 'id', 'product_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $title = str_replace('?', '', $product->title);
            $slug = preg_replace('/\s+/', '-', $title);
            $product->slug = $slug;
        });
        static::updating(function ($product) {
            $title = str_replace('?', '', $product->title);
            $slug = preg_replace('/\s+/', '-', $title);
            $product->slug = $slug;
        });
    }
}

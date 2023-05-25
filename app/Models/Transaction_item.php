<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'transaction_id'
    ];

    /**
     * Get the product associated with the Transaction_item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}

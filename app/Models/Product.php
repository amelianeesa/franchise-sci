<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'service_category_id',
        'nama_produk',
        'deskripsi',
        'harga_dasar',
        'satuan',
        'is_active',
    ];

    protected $casts = [
        'harga_dasar' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
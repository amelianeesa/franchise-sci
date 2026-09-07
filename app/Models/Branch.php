<?php
// app/Models/Branch.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'kode_cabang', 'nama_cabang', 'provinsi', 'kota',
        'alamat', 'latitude', 'longitude', 'telepon', 'is_active',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
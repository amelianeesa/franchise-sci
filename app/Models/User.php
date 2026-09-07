<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role',
        'jenis_pelanggan',
        'name',
        'email',
        'password',
        'npwp',
        'company_name',
        'jabatan',
        'phone',
        'whatsapp',
        'branch_id',
        'no_sertifikasi_keahlian',
        'bidang_keahlian',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'bidang_keahlian' => 'array',
    ];

    /**
     * Relasi: order-order yang diajukan user ini sebagai pelanggan.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    /**
     * Relasi: cabang tempat user bertugas (khusus admin_cabang).
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model
{
    protected $table = 'virtual_accounts';

    protected $fillable = [
        'branch_id',
        'bank_name',
        'va_number',
        'atas_nama',
        'is_active',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'kode_invoice',
        'order_id',
        'purchase_order_id',
        'branch_id',
        'total_tagihan',
        'va_number',
        'batas_waktu_pembayaran',
        'status_bayar',
        'paid_at',
        'created_by',
    ];
}
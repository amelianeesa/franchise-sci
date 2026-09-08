<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'kode_order',
        'customer_id',
        'branch_id',
        'product_id',
        'lokasi_pengerjaan',
        'tanggal_rencana_pelaksanaan',
        'status',
        'catatan_pelanggan',
    ];

    protected $casts = [
        'tanggal_rencana_pelaksanaan' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function trackingHistories()
    {
        return $this->hasMany(OrderHistory::class);
    }

    public static function trackingSteps(): array
    {
        return [
            'pengajuan' => 'Diajukan',
            'menunggu_persetujuan_penawaran' => 'Diajukan',
            'po_terbit' => 'Disetujui / PO Terbit',
            'dikerjakan' => 'Dikerjakan',
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'lunas' => 'Lunas',
            'selesai' => 'Selesai',
        ];
    }

    public function currentStepIndex(): int
    {
        $order = ['pengajuan', 'menunggu_persetujuan_penawaran', 'po_terbit', 'dikerjakan', 'menunggu_pembayaran', 'lunas', 'selesai'];
        $displaySteps = ['Diajukan', 'Disetujui / PO Terbit', 'Dikerjakan', 'Menunggu Pembayaran', 'Lunas', 'Selesai'];

        $map = [
            'pengajuan' => 0,
            'menunggu_persetujuan_penawaran' => 0,
            'po_terbit' => 1,
            'dikerjakan' => 2,
            'menunggu_pembayaran' => 3,
            'lunas' => 4,
            'selesai' => 5,
        ];

        return $map[$this->status] ?? 0;
    }
}
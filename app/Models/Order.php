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
        'alasan_penolakan',
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
    $map = [
        'pengajuan' => 0,
        'menunggu_persetujuan_penawaran' => 0,
        'po_terbit' => 1,
        'dikerjakan' => 2,
        'menunggu_pembayaran' => 3,
        'lunas' => 3,
        'selesai' => 4,
    ];

    return $map[$this->status] ?? 0;
}

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            'ditolak', 'dibatalkan' => 'bg-rose-100 text-rose-700 border border-rose-200',
            'selesai' => 'bg-emerald-100 text-emerald-700 border border-emerald-200',
            'lunas' => 'bg-sky-100 text-sky-700 border border-sky-200',
            'menunggu_pembayaran' => 'bg-amber-100 text-amber-700 border border-amber-200',
            default => 'bg-slate-200 text-slate-700 border border-slate-300',
        };
    }
}
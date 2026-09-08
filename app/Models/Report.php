<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'kode_laporan',
        'order_id',
        'job_assignment_id',
        'uploaded_by',
        'file_draft_path',
        'file_final_path',
        'status',
        'qr_code_value',
        'qr_code_image_path',
        'is_locked',
        'finalized_at',
        'finalized_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}

?>
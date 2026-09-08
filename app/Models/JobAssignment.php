<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobAssignment extends Model
{
    protected $table = 'job_assignments';

    protected $fillable = [
        'order_id',
        'branch_id',
        'tenaga_ahli_id',
        'assigned_by',
        'status',
        'assigned_at',
        'completed_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function tenagaAhli()
    {
        return $this->belongsTo(User::class, 'tenaga_ahli_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
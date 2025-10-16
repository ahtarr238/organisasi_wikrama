<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkProgram extends Model
{
    protected $fillable = [
        'organization_id',
        'nama_program',
        'deskripsi',
        'tgl_mulai',
        'tgl_selesai',
        'created_by'
    ];

    protected $dates = [
        'tgl_mulai',
        'tgl_selesai'
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
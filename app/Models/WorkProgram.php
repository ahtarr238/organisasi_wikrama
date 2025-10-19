<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkProgram extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'organization_id',
        'nama_program',
        'deskripsi',
        'tgl_mulai',
        'tgl_selesai',
        'created_by',
        'status'
    ];

    protected $attributes = [
        'status' => 'on_going'
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
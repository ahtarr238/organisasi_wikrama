<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galery extends Model
{
    use SoftDeletes;
    
    protected $table = 'galerries';
    
    protected $fillable = [
        'title',
        'category',
        'description',
        'photo_url',
        'uploaded_by',
        'uploaded_at'
    ];

    protected $dates = [
        'uploaded_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'category' => 'string'
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
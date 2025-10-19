<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
use HasFactory, Notifiable, SoftDeletes;

protected $fillable = [
'name',
'email',
'password',
'gender',
'birth_date',
'address',
'organization_id',
'role_id',
'role',
'join_date',
];

protected $hidden = [
'password',
'remember_token',
];

protected $casts = [
'email_verified_at' => 'datetime',
'password' => 'hashed',
'birth_date' => 'date',
'join_date' => 'date',
];

public function organization(): BelongsTo
{
return $this->belongsTo(Organization::class)->withTrashed();
}

public function dailyActivities(): HasMany
{
return $this->hasMany(DailyActivity::class);
}

public function workPrograms(): HasMany
{
return $this->hasMany(WorkProgram::class, 'created_by');
}

// Tambahkan relasi lain jika diperlukan
}
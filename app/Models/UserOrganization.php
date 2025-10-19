<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOrganization extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'organization_id', 'role_id', 'join_date', 'leave_date'];
}

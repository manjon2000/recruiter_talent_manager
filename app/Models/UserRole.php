<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'users_roles';
    protected $fillable = [
        'role_id',
        'user_id'
    ];

    protected $hidden = [
        'id',
        'role_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}

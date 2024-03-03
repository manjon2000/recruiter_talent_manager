<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'id',
        'name'
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function roles(): HasMany {
        return $this->hasMany(UserRole::class);
    }
}

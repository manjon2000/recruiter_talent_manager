<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CandidateSkill extends Model
{
    use HasFactory;

    protected $table = 'candidates_skills';

    protected $fillable = [
        'user_id',
        'tag_id'
    ];

    protected $with = [
        'tags'
    ];

    protected $hidden = [
        'id',
        'tag_id',
        'created_at',
        'updated_at'
    ];

    public function tags(): HasMany {
        return $this->hasMany(Tag::class, 'id', 'tag_id');
    }
}

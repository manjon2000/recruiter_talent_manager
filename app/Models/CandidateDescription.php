<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDescription extends Model
{
    use HasFactory;

    protected $table = 'candidates_description';

    protected $fillable = [
        'user_id',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateStudie extends Model
{
    use HasFactory;

    protected $table = 'candidates_studies';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start_date',
        'finish_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

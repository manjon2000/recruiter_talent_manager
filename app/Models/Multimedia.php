<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'multimedia';

    protected $fillable = [
        'name',
        'path',
        'text_alternative',
        'mimetype'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

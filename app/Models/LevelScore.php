<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelScore extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'level_1',
        'level_2',
        'level_3',
    ];

    protected function casts(): array
    {
        return [
            'level_1' => 'integer',
            'level_2' => 'integer',
            'level_3' => 'integer',
        ];
    }
}

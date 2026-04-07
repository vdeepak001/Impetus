<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSplitUp extends Model
{
    use HasFactory;

    protected $table = 'question_split_ups';

    protected $fillable = [
        'mock_l1',
        'mock_l2',
        'mock_l3',
        'pre_l1',
        'pre_l2',
        'pre_l3',
        'final_l1',
        'final_l2',
        'final_l3',
    ];
}

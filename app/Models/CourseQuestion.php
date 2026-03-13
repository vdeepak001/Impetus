<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'course_questions';

    protected $fillable = [
        'question_code',
        'course_id',
        'question_type',
        'question_level',
        'question',
        'choice_a',
        'choice_b',
        'choice_c',
        'choice_d',
        'answer',
        'reason',
    ];

    public function course()
    {
        return $this->belongsTo(CourseDetail::class, 'course_id');
    }
}

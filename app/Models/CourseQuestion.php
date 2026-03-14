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
        'user_id',
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
        'active_status',
    ];

    protected function casts(): array
    {
        return [
            'active_status' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(CourseDetail::class, 'course_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'title_materials';

    protected $fillable = [
        'user_id',
        'course_id',
        'course_title_id',
        'description',
        'attachment',
    ];

    protected $casts = [
        'attachment' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(CourseDetail::class, 'course_id');
    }

    public function courseTitle()
    {
        return $this->belongsTo(CourseTitle::class, 'course_title_id');
    }
}

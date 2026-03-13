<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTitle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'course_title';

    protected $fillable = [
        'course_id',
        'title_name',
        'title_description',
    ];

    public function course()
    {
        return $this->belongsTo(CourseDetail::class, 'course_id');
    }
}

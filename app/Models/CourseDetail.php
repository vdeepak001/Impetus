<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'course_details';

    protected $fillable = [
        'user_id',
        'course_id',
        'course_code',
        'couse_name',
        'course_url',
        'description',
        'attachment',
        'seo_key',
        'seo_title',
        'seo_des',
        'active_status',
        'sequence',
        'qa_content',
        'practice_content',
        'pre_test',
        'mock_test',
        'final_test',
    ];

    protected $casts = [
        'active_status' => 'integer',
        'sequence' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use App\Models\Pivots\CourseDetailStateCouncil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    /**
     * URL for the attachment: prefers file under public_path(), falls back to legacy storage symlink path.
     */
    public function attachmentPublicUrl(): ?string
    {
        if (! $this->attachment) {
            return null;
        }

        if (is_file(public_path($this->attachment))) {
            return asset($this->attachment);
        }

        return asset('storage/'.$this->attachment);
    }

    public function attachmentIsImage(): bool
    {
        if (! $this->attachment) {
            return false;
        }

        $ext = strtolower(pathinfo($this->attachment, PATHINFO_EXTENSION));

        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'avif'], true);
    }
    public function stateCouncils(): BelongsToMany
    {
        return $this->belongsToMany(StateCouncil::class, 'course_detail_state_council')
            ->using(CourseDetailStateCouncil::class)
            ->withPivot(['pass_percentage', 'mrp', 'offer_price', 'points', 'valid_days', 'pre_test_questions', 'mock_test_questions', 'final_test_questions'])
            ->withTimestamps();
    }
}

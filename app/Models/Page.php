<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property int|null $user_id
 * @property float|null $rating
 * @property bool $is_published
 * @property Carbon|null $published_at
 * @property Carbon|null $unpublished_at
 * @property Carbon|null $archived_at
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 * @property-read Carbon|null $deleted_at
 * @property-read User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static Builder|Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUnpublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereArchivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDeletedAt($value)
 * @method static Builder|Page withTrashed()
 * @method static Builder|Page withoutTrashed()
 * @mixin Eloquent
 */
class Page extends Model
{
    use HasFactory;
    use Timestamp;
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'body',
        'user_id',
        'rating',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'unpublished_at' => 'datetime',
        'archived_at' => 'datetime',
    ];

    /**
     * Returns the relationship between the Post model and the User model.
     *
     * @return BelongsTo
     */
    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

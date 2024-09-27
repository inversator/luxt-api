<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Database\Factories\PostFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * This is the Post model class.
 *
 * This class represents a single post in the database.
 *
 * @mixin Builder
 * @property-read int $id
 * @property-read Carbon $created_at
 * @property-read Carbon|null $updated_at
 * @property-read Carbon|null $deleted_at
 * @property string $slug
 * @property int $user_id
 * @property float|null $rating
 * @property bool $is_public
 * @property string $title
 * @property string $body
 * @property Carbon|null $published_at
 * @property Carbon|null $unpublished_at
 * @property Carbon|null $archived_at
 * @property-read User $user
 * @method static Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method Post firstOrNew(array $attributes = [], array $values = [])
 * @method Post firstOrFail($columns = ['*'])
 * @method Post firstOrCreate(array $attributes, array $values = [])
 * @method Post firstOr($columns = ['*'], \Closure $callback = null)
 * @method Post firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method Post updateOrCreate(array $attributes, array $values = [])
 * @method null|static first($columns = ['*'])
 * @method static static findOrFail($id, $columns = ['*'])
 * @method static static findOrNew($id, $columns = ['*'])
 * @method static null|static find($id, $columns = ['*'])
 * @method static PostFactory factory($count = null, $state = [])
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post onlyTrashed()
 * @method static Builder|Post withTrashed()
 * @method static Builder|Post withoutTrashed()
 * @mixin Eloquent
 */
class Post extends Model
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
        'is_public',

        'unpublished_at',
        'archived_at',
        'published_at',
    ];

    /**
     * Returns the relationship between the Post model and the User model.
     *
     * @return BelongsTo
     */
    protected $casts = [
        'is_published' => 'boolean',
        'rating' => 'integer',
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

<?php

namespace App\Models;

use App\Enum\TaskStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

/**
 * @property int $id
 * @property int $user_id,
 * @property string|null $status
 * @property int|null $priority
 * @property string|null $title
 * @property string|null $description
 * @property int|null $parent_id
 */
class Task extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    protected $fillable = [
        'user_id',
        'status',
        'priority',
        'title',
        'description',
        'completed_at',
        'parent_id'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'status' => TaskStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $query
     * @param string|null $search
     * @return void
     */
    public function scopeSearch(Builder $query, ?string $search = null): void
    {
        if (! empty($search)) {
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        }
    }
}

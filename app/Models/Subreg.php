<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Subreg
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int|null $area_id
 * @property string|null $original
 * @property string $preposition
 * @property string|null $from
 * @property string|null $adjective
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereAdjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg wherePreposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subreg whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wine[] $wines
 * @property-read int|null $wines_count
 * @property-read \App\Models\Area|null $area
 */
class Subreg extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'area_id',
        'original',
        'preposition',
        'from',
        'adjective',
        'description',
    ];

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $original
 * @property string $preposition
 * @property string|null $from
 * @property string|null $adjective
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereAdjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePreposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Area[] $areas
 * @property-read int|null $areas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wine[] $wines
 * @property-read int|null $wines_count
 */
class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
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

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }
}

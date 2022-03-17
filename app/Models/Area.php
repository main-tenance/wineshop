<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Area
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int|null $country_id
 * @property string|null $original
 * @property string $preposition
 * @property string|null $from
 * @property string|null $adjective
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wine[] $wines
 * @property-read int|null $wines_count
 * @method static \Illuminate\Database\Eloquent\Builder|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereAdjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area wherePreposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subreg[] $subregs
 * @property-read int|null $subregs_count
 * @property-read \App\Models\Country|null $country
 */
class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'country_id',
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

    public function subregs(): HasMany
    {
        return $this->hasMany(Subreg::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}

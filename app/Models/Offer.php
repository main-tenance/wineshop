<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * App\Models\Offer
 *
 * @property int $id
 * @property int $active
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property int $wine_id
 * @property int|null $sugar_id
 * @property float $spirt
 * @property int $volume
 * @property int|null $year
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereSpirt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereSugarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereWineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereYear($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\Sugar|null $sugar
 * @property-read \App\Models\Wine $wine
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vine[] $vines
 * @property-read int|null $vines_count
 */
class Offer extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'active',
        'name',
        'code',
        'description',
        'wine_id',
        'sugar_id',
        'spirt',
        'volume',
        'year',
        'price',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only([
            'sugar',
        ]);
    }

    protected function makeAllSearchableUsing($query)
    {
        return $query->with(['sugar']);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function wine(): BelongsTo
    {
        return $this->belongsTo(Wine::class);
    }

    public function sugar(): BelongsTo
    {
        return $this->belongsTo(Sugar::class);
    }

    public function vines(): BelongsToMany
    {
        return $this->belongsToMany(Vine::class)->using(OfferVine::class);
    }
}

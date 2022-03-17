<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * App\Models\Wine
 *
 * @property int $id
 * @property int $active
 * @property string $name
 * @property string|null $original
 * @property string|null $description
 * @property int $category_id
 * @property int $creator_id
 * @property int $country_id
 * @property int|null $area_id
 * @property int|null $color_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Wine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Color|null $color
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\Creator $creator
 */
class Wine extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'active',
        'name',
        'original',
        'description',
        'category_id',
        'creator_id',
        'country_id',
        'area_id',
        'color_id',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only([
            'name',
            'original',
            'category',
            'creator',
            'country',
            'area',
            'color',
        ]);
    }

    protected function makeAllSearchableUsing($query)
    {
        return $query->with(['category', 'creator', 'country', 'area', 'color']);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Creator::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}

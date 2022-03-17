<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

/**
 * App\Models\Vine
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Vine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vine whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 */
class Vine extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public function toSearchableArray()
    {
        return $this->only([
            'name',
            'code',
        ]);
    }

    public function offers(): BelongsToMany
    {
        return $this->belongsToMany(Offer::class)->using(OfferVine::class);
    }

}

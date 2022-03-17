<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

/**
 * App\Models\Creator
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $original
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Creator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Creator whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creator whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creator whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creator whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wine[] $wines
 * @property-read int|null $wines_count
 */
class Creator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'original',
        'description',
        'img_ig',
    ];

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function offers()
    {
        return $this->hasManyThrough(Offer::class, Wine::class);
    }

    protected static function booted()
    {
        static::created(function ($creator) {
            Cache::tags('creators')->flush();
        });

        static::updated(function ($creator) {
            Cache::tags('creators')->flush();
        });

        static::saved(function ($creator) {
            Cache::tags('creators')->flush();
        });

        static::deleted(function ($creator) {
            Cache::tags('creators')->flush();
        });
    }

}

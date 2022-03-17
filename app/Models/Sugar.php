<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Sugar
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sugar whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 */
class Sugar extends Model
{
    use HasFactory;

    protected $table = 'sugars';

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}

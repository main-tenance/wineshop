<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property string $name
 * @property string|null $active_from
 * @property string|null $active_to
 * @property string $discount_type
 * @property float $discount_value
 * @property mixed|null $conditions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\DiscountFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereActiveFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereActiveTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 */
class Discount extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $cast = [
        'conditions' => 'array',
    ];

    protected $fillable = [
        'name',
        'active_from',
        'active_to',
        'discount_type',
        'discount_value',
        'conditions',
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }


    public function getAttributesWithGroups()
    {
        $attributes = $this->getAttributes();
        $attributes['groups'] = $this->groups->pluck('pivot')->pluck('group_id')->toArray();
        return $attributes;
    }
}

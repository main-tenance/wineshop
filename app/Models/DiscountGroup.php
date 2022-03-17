<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\DiscountGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $discount_id
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup whereDiscountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountGroup whereUpdatedAt($value)
 */
class DiscountGroup extends Pivot
{
    //
}

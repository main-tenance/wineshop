<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\OfferVine
 *
 * @property int $id
 * @property int $offer_id
 * @property int $vine_id
 * @property int|null $position
 * @property int|null $percent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVine whereVineId($value)
 * @mixin \Eloquent
 */
class OfferVine extends Pivot
{
    //
}

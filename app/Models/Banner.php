<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Banner
 *
 * @property int $id
 * @property int $active
 * @property string $code
 * @property string $title
 * @property string|null $href
 * @property string|null $big_title
 * @property string|null $small_title
 * @property string|null $notice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BannerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereBigTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereSmallTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Banner extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'active',
        'code',
        'title',
        'href',
        'big_title',
        'small_title',
        'notice',
    ];
}

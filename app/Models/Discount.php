<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property string $code
 * @property string $type
 * @property string $value
 * @property int|null $usage_limit
 * @property int $usage_limit_per_customer
 * @property int $total_use
 * @property \Illuminate\Support\Carbon $starts_at
 * @property \Illuminate\Support\Carbon $ends_at
 * @property bool $is_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereTotalUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUsageLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUsageLimitPerCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereValue($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
    use HasFactory;


    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'type',
        'value',
        'usage_limit',
        'usage_limit_per_customer',
        'total_usage',
        'starts_at',
        'ends_at',
        'is_visible',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}

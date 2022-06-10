<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $sku
 * @property string|null $barcode
 * @property string|null $description
 * @property int $qty
 * @property int $security_stock
 * @property int $featured
 * @property int $is_visible
 * @property string|null $old_price
 * @property string|null $price
 * @property string|null $cost
 * @property string|null $published_at
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int|null $brand_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Brand|null $brand
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product visible()
 * @method static Builder|Product whereBarcode($value)
 * @method static Builder|Product whereBrandId($value)
 * @method static Builder|Product whereCost($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereFeatured($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereIsVisible($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereOldPrice($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product wherePublishedAt($value)
 * @method static Builder|Product whereQty($value)
 * @method static Builder|Product whereSecurityStock($value)
 * @method static Builder|Product whereSeoDescription($value)
 * @method static Builder|Product whereSeoTitle($value)
 * @method static Builder|Product whereSku($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function scopeVisible($query):Builder
    {
        return $query->where('is_visible', 1)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '>=', Carbon::now()->format('Y-m-d'));
            });
    }

    public function offer()
    {
        return $this->hasOne(Discount::class,'product_id');
    }
}

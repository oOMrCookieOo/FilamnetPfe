<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wilaya
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wilaya whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Wilaya extends Model
{
    use HasFactory;
}

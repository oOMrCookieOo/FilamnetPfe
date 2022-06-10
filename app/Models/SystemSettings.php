<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SystemSettings
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $key
 * @property string|null $display_name
 * @property string|null $value
 * @property int $locked
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereValue($value)
 * @mixin \Eloquent
 */
class SystemSettings extends Model
{
    use HasFactory;
}

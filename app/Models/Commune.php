<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Commune
 *
 * @property int $id
 * @property int $wilaya_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Commune newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commune newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commune query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereWilayaId($value)
 * @mixin \Eloquent
 */
class Commune extends Model
{
    use HasFactory;
}

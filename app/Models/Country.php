<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $country_name
 * @property string $flag
 * @property string $calling_code
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
      'country_name',
      'flag',
      'calling_code'
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_countries', 'country_id', 'user_id')->withTimestamps();
    }
}

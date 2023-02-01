<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property Country $country
 * @property PhoneBook $phoneBook
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email'
    ];

    /**
     * Get the user phone.
     *
     * @return string
     */
    public function getPhoneAttribute(): string
    {
        return $this->phoneBook->phone;
    }

    public function phoneBook(): hasOne
    {
        return $this->hasOne(PhoneBook::class);
    }

    public function country(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'user_countries', 'user_id', 'country_id')->withTimestamps();;
    }
}

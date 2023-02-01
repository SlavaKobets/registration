<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class PhoneBook extends Model
{
    use HasFactory;

    protected $table = 'phone_book';

    protected $fillable = [
       'user_id',
       'phone'
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}

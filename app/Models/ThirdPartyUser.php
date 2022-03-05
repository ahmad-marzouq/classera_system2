<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\ThirdPartyUser
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $role
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdPartyUser whereRole($value)
 */
class ThirdPartyUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
    ];
}

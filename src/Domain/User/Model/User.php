<?php

namespace Domain\User\Model;

use Domain\CarePlan\Model\CarePlan;
use Domain\Notification\Model\Notification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Sanctum\HasApiTokens;
use Support\Model;

/**
 * @property string $id
 * @property string $firstName
 * @property string $lastName
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable;
    use Authorizable;
    use HasFactory;
    use HasUuids;
    use HasApiTokens;

    public function carePlan(): HasOne
    {
        return $this->hasOne(CarePlan::class);
    }

    public function teams()
    {
        //
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}

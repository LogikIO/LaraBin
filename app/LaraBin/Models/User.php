<?php

namespace App\LaraBin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';

    protected $fillable = ['username', 'email', 'password', 'verified'];

    protected $hidden = ['password', 'remember_token'];

    public function passwordReset()
    {
        return $this->hasOne('\App\LaraBin\Models\Auth\PasswordReset');
    }

    public function emailVerification()
    {
        return $this->hasOne('\App\LaraBin\Models\Auth\EmailVerification');
    }

    // Methods

    /**
     * Check if user has verified their email address
     *
     * @return bool
     */
    public function verified()
    {
        return ($this->verified) ? true : false;
    }

    /**
     * Determine if user is Administrator
     *
     * @return bool
     */
    public function admin()
    {
        return ($this->is_admin) ? true : false;
    }

    // Scopes

    /**
     * Only grab users who are verified
     *
     * @param $query
     */
    public function scopeVerified($query)
    {
        $query->where('verified', true);
    }
}

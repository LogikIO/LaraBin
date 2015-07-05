<?php

namespace App\LaraBin\Models;

use App\LaraBin\Helpers\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Gravatar;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'username', 'email',
        'password', 'verified', 'github_token',
        'github_avatar',
        'settings', 'last_login'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['last_login'];

    protected $casts = [
        'settings' => 'array'
    ];

    public function passwordReset()
    {
        return $this->hasOne('\App\LaraBin\Models\Auth\PasswordReset');
    }

    public function emailVerification()
    {
        return $this->hasOne('\App\LaraBin\Models\Auth\EmailVerification');
    }

    public function bins()
    {
        return $this->hasMany('\App\LaraBin\Models\Bins\Bin');
    }

    public function snippets()
    {
        return $this->hasManyThrough('\App\LaraBin\Models\Bins\Snippets\Snippet', '\App\LaraBin\Models\Bins\Bin');
    }

    // Methods

    public function settings()
    {
        return new Settings($this->settings, $this);
    }

    /**
     * Check if user has verified their email address
     *
     * @return bool
     */
    public function verified()
    {
        return ($this->verified) ? true : false;
    }

    public function avatar($size = 80)
    {
        return Gravatar::src($this->email, $size);
    }

    public function url()
    {
        return route('user', $this->username);
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

    /**
     * Check if user is using GitHub
     *
     * @return bool
     */
    public function usingGithub()
    {
        return ($this->github_token) ? true : false;
    }

    // Scopes

    /**
     * Only grab users who are verified
     *
     * @param $query
     */
    public function scopeVerifiedOnly($query)
    {
        $query->where('verified', true);
    }
}

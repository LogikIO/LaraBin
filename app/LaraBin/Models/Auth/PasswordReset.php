<?php

namespace App\LaraBin\Models\Auth;

use App\LaraBin\Models\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PasswordReset extends Model
{
    protected $table = 'password_resets';

    protected $fillable = ['user_id', 'token', 'created_at'];

    public $timestamps = false;

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods

    /**
     * Check if user password reset token has expired
     * Tokens expire 15 minutes after creation
     *
     * @return bool
     */
    public function expired()
    {
        return ($this->created_at < Carbon::now()->subMinutes(15)) ? true : false;
    }

    // Scopes

}

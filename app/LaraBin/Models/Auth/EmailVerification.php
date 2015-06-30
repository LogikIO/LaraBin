<?php

namespace App\LaraBin\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailVerification extends Model
{
    protected $table = 'email_verifications';

    protected $fillable = ['user_id', 'token', 'created_at'];

    public $timestamps = false;

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo('\App\LaraBin\Models\User');
    }

    // Methods

    /**
     * Check if user password reset token has expired
     * Tokens expire 1 hour after creation
     *
     * @return bool
     */
    public function expired()
    {
        return ($this->created_at < Carbon::now()->subHour()) ? true : false;
    }

    // Scopes

}

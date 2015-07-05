<?php

namespace App\LaraBin\Models\Bins\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['bin_id', 'user_id', 'message'];

    public function bin()
    {
        return $this->belongsTo('\App\LaraBin\Models\Bins\Bin');
    }
}

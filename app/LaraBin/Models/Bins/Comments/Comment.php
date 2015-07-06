<?php

namespace App\LaraBin\Models\Bins\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['bin_id', 'user_id', 'message'];

    protected $with = ['user'];

    protected $touches = ['bin'];

    public function bin()
    {
        return $this->belongsTo('\App\LaraBin\Models\Bins\Bin');
    }

    public function user()
    {
        return $this->belongsTo('\App\LaraBin\Models\User');
    }

    // Methods
    public function modified()
    {
        return ($this->updated_at > $this->created_at) ? true : false;
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return hashid()->encode($this->getKey());
    }

    public function getCommentUrl()
    {
        $comments = $this->where('bin_id', $this->bin_id)->lists('id')->all();
        $pages = array_chunk($comments, 10);
        foreach($pages as $page => $comments) {
            $pageNumber = $page + 1;
            foreach($comments as $key => $commentId) {
                if ($commentId == $this->id) {
                    return route('bin.comments', $this->bin->getRouteKey()) . '?page=' . $pageNumber . '#' . $this->getRouteKey();
                }
            }
        }
    }
}

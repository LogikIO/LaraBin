<?php

namespace App\LaraBin\Models\Bins;

use App\LaraBin\Models\Bins\Comments\Comment;
use App\LaraBin\Models\Bins\Snippets\Snippet;
use App\LaraBin\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    protected $table = 'bins';

    protected $with = ['versions'];

    protected $fillable = ['user_id', 'title', 'description', 'visibility', 'version_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function snippets()
    {
        return $this->hasMany(Snippet::class);
    }

    public function versions()
    {
        return $this->belongsToMany(Version::class)->orderBy('name');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Methods

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return hashid()->encode($this->getKey());
    }

    /**
     * Return the encoded hashid url for the object
     *
     * @return string
     */
    public function url()
    {
        return route('bin.code', $this->getRouteKey());
    }

    public function shareUrl()
    {
        return route('bin.private', [$this->getRouteKey(), $this->private_hash]);
    }

    public function commentsUrl()
    {
        return route('bin.comments', $this->getRouteKey());
    }

    public function tweeted()
    {
        if (auth()->check() && auth()->user()->admin()) {
            return ($this->tweeted) ? true : false;
        }
    }

    /**
     * Check if a bin is private
     * 0 = private, 1 = public, 2 = unlisted but public
     *
     * @return bool
     */
    public function isPrivate()
    {
        return ($this->visibility == 0) ? true : false;
    }

    public function isShared()
    {
        return ($this->private_hash) ? true : false;
    }

    public function isPublic()
    {
        return ($this->visibility == 1) ? true : false;
    }

    public function label()
    {
        switch ($this->visibility) {
            case 0: return '<span class="label-visibility label label-warning">Private</span>';
            case 1: return '<span class="label-visibility label label-success">Public</span>';
            case 2: return '<span class="label-visibility label label-default">Unlisted</span>';
        }
    }

    public function versions_label()
    {
        $html = '';
        $versions = $this->versions->lists('name')->all();
        foreach($versions as $version) {
            $html .= '<span class ="label label-versions">' . $version . '</span>';
        }

        return $html;
    }

    public function modified()
    {
        return ($this->updated_at > $this->created_at) ? true : false;
    }

    // Scopes

    /**
     * Only return bins that are public
     *
     * @param $query
     */
    public function scopePublicOnly($query)
    {
        $query->where('visibility', 1);
    }

    public function scopeVersion($query, $versions)
    {
        $query->whereHas('versions', function($q) use ($versions) {
            $q->where('name', $versions);
        });
    }
}

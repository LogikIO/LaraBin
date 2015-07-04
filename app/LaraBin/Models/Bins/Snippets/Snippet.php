<?php

namespace App\LaraBin\Models\Bins\Snippets;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $table = 'snippets';

    protected $fillable = ['bin_id', 'type_id', 'name', 'code'];

    protected $with = ['type'];

    protected $touches = ['bin'];

    public function bin()
    {
        return $this->belongsTo('\App\LaraBin\Models\Bins\Bin');
    }

    public function type()
    {
        return $this->belongsTo('\App\LaraBin\Models\Bins\Snippets\Type');
    }

    public function label()
    {
        return '<span class="label label-info">' . $this->type->display . '</span>';
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
     * Check if snippet has a type, if so, we syntax highlight
     *
     * @return bool
     */
    public function hasType()
    {
        return ($this->type_id) ? true : false;
    }

    public function url()
    {
        return route('bin.snippet', [hashid()->encode($this->bin_id), hashid()->encode($this->id)]);
    }

    /**
     * Return css class for highlighting
     *
     * @return string
     */
    public function cssClass()
    {
        if ($this->hasType()) {
            return $this->type->css_class;
        }
    }

    // Scopes
    public function scopePublicOnly($query)
    {
        $query->whereHas('bin', function($q) {
            $q->where('visibility', 1);
        });
    }
}

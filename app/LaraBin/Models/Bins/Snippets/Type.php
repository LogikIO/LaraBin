<?php

namespace App\LaraBin\Models\Bins\Snippets;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'snippet_types';

    protected $fillable = ['display', 'css_class'];

    public function snippets()
    {
        return $this->hasMany('\App\LaraBin\Models\Bins\Snippets\Snippet', 'type_id', 'id');
    }
}

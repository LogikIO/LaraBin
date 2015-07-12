<?php

namespace App\LaraBin\Models\Bins;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $tables = 'versions';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function bins()
    {
        return $this->belongsToMany(Bin::class);
    }
}

<?php

namespace App\Http\Controllers\Bins;

use App\LaraBin\Models\Bins\Bin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function comments(Bin $bin)
    {
        return view('bin.show.code', compact('bin'));
    }
}

<?php

namespace App\Http\Controllers;

use App\LaraBin\Models\Bins\Bin;
use App\LaraBin\Models\Bins\Snippets\Snippet;
use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $sample = '<?php


class Idea extends Eloquent {

    /**
     * Dreaming of something more?
     *
     * @with  Laravel
     */
     public function create()
     {
        // Have a fresh start...
     }

}';
        $artisans = User::verifiedOnly()->count();
        $bins = Bin::publicOnly()->count();
        $files = Snippet::publicOnly()->count();
        return view('home', compact('sample', 'artisans', 'bins', 'files'));
    }
}

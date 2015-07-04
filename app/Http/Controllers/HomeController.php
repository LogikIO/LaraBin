<?php

namespace App\Http\Controllers;

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
        return view('home', compact('sample'));
    }
}

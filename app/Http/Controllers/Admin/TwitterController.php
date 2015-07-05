<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Twitter;

class TwitterController extends Controller
{
    public function index()
    {
        $tweets = Twitter::getUserTimeline(['screen_name' => 'larabincom', 'count' => 20]);

        return view('admin.twitter.index', compact('tweets'));
    }

    public function newTweet()
    {
        return view('admin.twitter.new');
    }

    public function newTweetPost(Requests\Admin\Twitter\NewTweet $request)
    {
        Twitter::postTweet(['status' => $request->input('message')]);
        session()->flash('success', 'Tweet successfully posted!');

        return redirect()->route('admin.twitter');
    }

    public function delete()
    {

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\LaraBin\Models\Bins\Bin;
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

    public function tweetBin(Bin $bin)
    {
        $status = 'Bin: #laravel ' . $bin->url() . ' ' . $bin->title;
        Twitter::postTweet(['status' => str_limit($status, 135), 'format' => 'json']);
        $bin->tweeted = true;
        $bin->save();
        session()->flash('success', 'Bin has successfully been tweeted!');

        return redirect()->back();
    }
}

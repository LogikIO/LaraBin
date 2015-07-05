<?php

namespace App\Http\Controllers\Bins;

use App\Events\Bin\UserCommentedOnBin;
use App\LaraBin\Models\Bins\Bin;
use App\LaraBin\Models\Bins\Comments\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function comments(Bin $bin)
    {
        $comments = $bin->comments()->paginate(10);

        return view('bin.show.code', compact('bin', 'comments'));
    }

    public function newComment(Bin $bin, Requests\Bins\NewComment $request)
    {
        $comment = $bin->comments()->create([
           'user_id' => auth()->user()->getAuthIdentifier(),
            'message' => $request->input('message')
        ]);
        if ($bin->user_id !== auth()->user()->getAuthIdentifier()) {
            event(new UserCommentedOnBin($comment));
        }

        session()->flash('success', 'Success! Comment added!');

        return redirect()->to($comment->getCommentUrl());
    }

    public function edit(Bin $bin, Comment $comment)
    {
        return view('bin.show.code', compact('bin', 'comment'));
    }

    public function editPost(Bin $bin, Comment $comment, Requests\Bins\NewComment $request)
    {
        $comment->update([
            'message' => $request->input('message')
        ]);
        session()->flash('success', 'Comment updated successfully!');

        return redirect()->to($comment->getCommentUrl());
    }

    public function delete(Bin $bin, Comment $comment)
    {
        return view('bin.show.code', compact('bin', 'comment'));
    }

    public function deletePost(Bin $bin, Comment $comment)
    {
        $comment->delete();
        session()->flash('success', 'Comment deleted successfully!');

        return redirect()->route('bin.code', $bin->getRouteKey());
    }
}

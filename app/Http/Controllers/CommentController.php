<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // comment list
    public function index()
    {
        $comments = Comment::leftJoin('users', 'users.id', 'comments.user_id')
        ->leftjoin('posts', 'posts.id', 'comments.post_id')
        ->select('comments.*', 'users.name as user_name', 'posts.title as post_title')->get();

        // dd($comments);
        return view('admin.comment.index', compact('comments'));
    }

    // delete comment
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back();
    }
}

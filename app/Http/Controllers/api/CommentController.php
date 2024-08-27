<?php

namespace App\Http\Controllers\api;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    // get Comments
    public function getComments(Request $request)
    {
        $comments = Comment::join('users', 'users.id', 'comments.user_id')
            ->select('comments.*', 'users.name as user_name')
            ->where('comments.post_id', $request->postId)->get();

        logger($comments);

        return response()->json(['comments' => $comments, 'status' => 200]);
    }

    // create comment
    public function createComment(Request $request)
    {
        // logger($request->all());
        $comment = Comment::create([
            "user_id" => $request->user_id,
            "post_id" => $request->post_id,
            "description" => $request->post_comment
        ]);


        return response()->json(['comment' => $comment, 'status' => 200]);
    }
}

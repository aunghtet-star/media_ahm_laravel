<?php

namespace App\Http\Controllers\api;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\Post;

class ActionLogController extends Controller
{
    // view count
    public function viewCount(Request $request)
    {
        if (!empty($request->userId)) {
            // logger('empty');

            $post = Post::findOrFail($request->postId);
            // logger($post);
            // user id ရှိပေမယ့် မရှိတဲ့ post id ကို url ကနေလျောက်ရိုက်ရင် trend post မှာ error မတတ်အောင်လို့
            if ($post) {
                $data = [
                    'user_id' => $request->userId,
                    'post_id' => $request->postId
                ];

                ActionLog::create($data);

                $actionLogData = ActionLog::where('post_id', $request->postId)->get();

                return response()->json(['post' => $actionLogData, 'isLogginedStatus'=>true]);
            }
        }

        return response()->json(['status'=>401, 'isLogginedStatus'=>false]);
    }
}

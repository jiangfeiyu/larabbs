<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content  = $request->content;
        $reply->user_id  = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();
        return redirect()->route('topics.show', $reply->topic->id)->with('message', '创建成功!');
        //return redirect()->to($reply->topic->id)->with('success', '创建成功！');
    }


    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();
        return redirect()->route('topics.show', $reply->topic->id)->with('success', '删除成功！');
    }
}
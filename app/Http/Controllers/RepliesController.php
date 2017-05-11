<?php

namespace App\Http\Controllers;

use App\Model\Reply;
use App\Model\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request$request, $channel_id, Thread $thread)
    {
        $reply = new Reply([
            'user_id'   => auth()->id(),
            'body'      => $request->body,
        ]);
        $thread->addReply($reply);

        return back();

    }
}

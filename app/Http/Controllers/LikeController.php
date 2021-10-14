<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request,Post $post, Like $like)
    {
        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;
        $like->save();
        return back();
    }

    public function destroy(Request $request, Post $post, Like $like)
    {
        $user_id = Auth::user()->id;
        $like = Like::where('post_id', $post->id)->where('user_id', $user_id)->first();
        $like->delete();

        return back();
    }
}

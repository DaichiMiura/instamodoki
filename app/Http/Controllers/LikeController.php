<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Post;
use Auth;

class LikeController extends Controller
{
    public function index(int $post_id)
    {
        $likes = Like::where('post_id', $post_id)->get();

        return view('likes.users', [
            'likes' => $likes,
        ]);
    }

    public function createOrDestroyLike(Request $request)
    {
        $post_id = $request->post_id;

        $post = Post::find($post_id);

        if (!$post) {
            return redirect()->route('home');
        }

        $like = Like::where('post_id', $post_id)->where('user_id', Auth::id())->first();

        if ($like) {
            Like::find($like->id)->delete();
        } else {
            $like          = new Like;
            $like->user_id = Auth::id();
            $like->post_id = $post_id;
            $like->save();
        }

        return redirect()->route('likes', ['post_id' => $post_id]);
    }
}

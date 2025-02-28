<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PosteController extends Controller
{
    public function create($profileId = null)
    {
        $user = auth()->user();
        $friends = $user->friend(); 

        $userIds = $friends->push($user->id);

        if ($profileId) {
            $userIds->push($profileId);
        }

        $posts = Post::whereIn('user_id', $userIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Post', compact('posts') , compact('user'));
    }


    public function likePost($postId)
    {
        $user = auth()->user();

        $like = Like::where('user_id', $user->id)->where('post_id', $postId)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like supprimé']);
        } else {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $postId
            ]);
            return response()->json(['message' => 'Post liké']);
        }
    }

    







}

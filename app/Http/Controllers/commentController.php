<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class commentController extends Controller
{
        public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'Commentaire ajouté',
            'comment' => $comment->load('user')
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MonPosteController extends Controller
{
    public function create(){
        $posts = Post::where('user_id', auth()->id())
             ->with('user:id,name,profile_picture')
             ->get();  

        return view('monPost' , compact('posts'));
    }

    public function store(){
        
        request()->validate([
            'content' => ['required','string'],
            'image' => ['nullable' , 'image' , 'mimes:jpeg,png,jpg,gif,svg' , 'max:2048']
        ]);

        $uploadPath = public_path('image_post');
        if(!file_exists($uploadPath)){
            mkdir($uploadPath,0755,true);
        }
        $imageName = null;
        if(request()->file('image')){
            $imageName = time() . '.' . request()->image->extension();
            request()->image->move($uploadPath , $imageName);
        }

        Post::create([
            'user_id' => auth()->id(), 
            'content' => request()->input('content'),
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Post ajouté avec succès !');

    }
}

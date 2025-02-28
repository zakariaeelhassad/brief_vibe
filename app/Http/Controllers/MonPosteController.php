<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function delete($id)
    {
        $post = Post::findOrFail($id); 

        $post->delete();

        return redirect()->back()->with('success', 'Post supprimé avec succès.');
    }


    public function update(Request $request, $id) {
        $Validated = $request->validate([
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
    
        $post = Post::findOrFail($id);
        $post->content = $Validated['content'];
    
        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path('image_post/' . $post->image))) {
                unlink(public_path('image_post/' . $post->image));
            }
    
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image_post'), $imageName);
    
            $post->image = $imageName;
        }
    
        $post->save();
    
        return redirect()->back()->with('success', 'Post modifié avec succès.');
    }
    
    
}

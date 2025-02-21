<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $users = User::all(); 

        return view('/home', compact('users'));    
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $users = User::where('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->paginate(10);

        return view('home', compact('users', 'query'));
    }

}

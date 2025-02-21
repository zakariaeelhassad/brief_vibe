<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sessionController extends Controller
{
    public function  create(){
        return view('login');
    }

    public function store(){

        $attributes = request()->validate([
                'email' => ['required' , 'email'],
                'password' => ['required']
            ]);
        
        Auth::attempt($attributes);

        request()->session()->regenerate();

        return redirect('home');
    }

    public function destroy(){
        Auth::guard('web')->logout();
        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('home');
    }
}

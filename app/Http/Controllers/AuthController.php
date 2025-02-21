<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function create(){
        return view('signup');
    }

    public function register()
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required' , 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required']
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect(('/'));
    }
    


}

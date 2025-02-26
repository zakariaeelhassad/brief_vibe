<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AfichageProfilController extends Controller
{
    public function profil($id) {
        $user = User::findOrFail($id); 
        return view('profil', compact('user'));
    }
    
}

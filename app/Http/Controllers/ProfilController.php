<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
            'password' => ['nullable', 'min:6'],
            'new_password' => ['nullable', 'min:6'],
            'password_confirmation' => ['same:new_password'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password') && Hash::check($request->password, $user->password)) {
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password);
            }
        } elseif ($request->filled('password')) {
            return back()->withErrors(['password' => 'Le mot de passe actuel est incorrect.']);
        }

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }


        $user->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
    
    public function delete(Request $request)
    {    
        $user = Auth::user();
    
        Auth::logout(); 
    
        $user->delete(); 
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('success', 'تم حذف الحساب بنجاح.');
    }
    
}

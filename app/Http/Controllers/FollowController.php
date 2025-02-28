<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow($userId)
    {
        $user = auth()->user();
        $followedUser = User::findOrFail($userId);

        if($user->id == $followedUser->id){
            return redirect()->back()->with('error',',,zeof,zze,fpoz');
        }

        $exitFollow = Follow::where('follower_id' , $user->id)
                            ->where('following_id' , $followedUser->id)
                            ->where('status', 'pending')
                            ->exists();

        if ($exitFollow) {
            return redirect()->back()->with('error', 'Follow request already sent');
        }

        Follow::create([
            'follower_id' => $user->id,
            'following_id' => $followedUser->id,
        ]);

        return redirect()->back()->with('success' , 'adzbjkdazd');
    }     
    
    public function acceptFollow($userId)
    {
        $user = auth()->user();

        $followRequest = Follow::where('follower_id' , $userId)
                                ->where('following_id' , $user->id)
                                ->where('status', 'pending')
                                ->first();

        if(!$followRequest){
            return redirect()->back()->with('error' , 'No follow request found');
        }

        $followRequest->status = 'accepted';
        $followRequest->save();

        return redirect()->back()->with('success' , 'follow request accepted');
    }

    public function rejectFollow($userId)
    {
        $user = auth()->user();
        $followRequest = Follow::where('follower_id' , $userId)
                                ->where('following_id' , $user->id)
                                ->where('status', 'pending')
                                ->first();
        if(!$followRequest){
            return redirect()->back()->with('error' , 'No follow request found');
        }

        $followRequest->delete();

        return redirect()->back()->with('success' , 'follow request rejected');
    }

    public function pendingRequests()
    {
        $user = auth()->user();

        $followRequests = $user->pendingFollowers()->with('follower')->get();

        return view('reseau', compact('followRequests'));
    }

    public function friendsList()
    {
        $user = auth()->user();
        $friends = $user->friends()->get();
        
        return view('friends', compact('friends'));
    }

    public function unfollow($userId)
    {
        $user = auth()->user();

        $follow = Follow::where('follower_id', $user->id)
                        ->where('following_id', $userId)
                        ->where('status', 'accepted')
                        ->first();

        if ($follow) {
            $follow->delete();
            return redirect()->back()->with('success', 'You have unfollowed this user.');
        }

        return redirect()->back()->with('error', 'You are not following this user.');
    }





}

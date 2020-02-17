<?php

namespace App\Http\Controllers;
use App\User;
use App\Friedns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FriendController extends Controller
{
    // Suggested Friend
    public function suggestedFriends()
    {
        $uid = Auth::user()->id;
        // $users = User::leftJoin('profiles', 'profiles.uid', '=', 'users.id')->where('users.id', '=', $uid)->get();
        $users = User::where('id', '!=', $uid)->get();
        return view('pages.friend.suggested-friends', compact('users'));
    }

    // Your Friend List
    public function allFriends(){
        $uid = Auth::user()->id;
        $myfriends = Friedns::rightJoin('users', 'users.id', '=', 'friedns.friend_two')
                -> where('friedns.friend_one', '=', $uid)
                ->where('friedns.status', '=', 1)->get();

        $friendTwo = Friedns::rightJoin('users', 'users.id', '=', 'friedns.friend_one')
        -> where('friedns.friend_two', '=', $uid)
        ->where('friedns.status', '=', 1)->get();
        return view('pages.friend.friend-list', compact('myfriends', 'friendTwo'));
    }



    // Sent Friend Request
    public function addFriend($id){
        if($id){
            $form_data = array(
                'friend_one'=> Auth::user()->id,
                'friend_two'=> $id
            );
           
            Friedns::create($form_data);
            return redirect()->back()->with('success', 'Friend request sent .');
        }else{
            return abort(404);
        }
    }


    // Friend Requests
    public function friendRequests(){
        $uid = Auth::user()->id;
        $requests = Friedns::rightJoin('users', 'users.id', '=', 'friedns.friend_one')
                -> where('friedns.friend_two', '=', $uid)
                ->where('friedns.status', '=', 0)->get();
        return view('pages.friend.friend-requests', compact('requests'));
    }


    // Accept Request
    public function acceptRequest($id){
        $uid = Auth::user()->id;
        $checkRequest = Friedns::where('friend_one', $id)
                        ->where('friend_two', $uid)
                        ->first();
        if($checkRequest){
            $accept = Friedns::where('friend_two', $uid)
                      ->where('friend_one', $id)
                      ->update(['status' => 1]);
                      if($accept){
                        return redirect()->back()->with('success', 'Request accept success .');
                      }
            
        }else {
            return redirect()->back()->with('success', 'Wrong submit .');
        }
    }

}
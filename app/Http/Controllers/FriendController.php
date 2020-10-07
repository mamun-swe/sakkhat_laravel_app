<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function myId()
    {
        return auth()->id();
    }

    public function index()
    {
        $suggested_friends = User::where('id', '!=', $this->myId())->get();
        return view('pages.friend.index', compact('suggested_friends'));
    }

    public function sendRequest($id)
    {
        $checkAvailable = Friend::where('friend_one', '=', $this->myId())
            ->where('friend_two', '=', $id)
            ->first();

        if ($checkAvailable != null) {
            return redirect()->back()->with('exist', 'Request already sent.');
        } else {
            dd($checkAvailable);
        }
    }

}

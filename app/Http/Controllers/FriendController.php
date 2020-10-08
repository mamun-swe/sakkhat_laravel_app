<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    // Auth Id
    public function myId()
    {
        return auth()->id();
    }

    // Unique array
    public function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    // Peoples
    public function index()
    {
        $suggested_peoples = User::where('id', '!=', $this->myId())
            ->select('id', 'name', 'profile_image')
            ->get();

        $set_requests = Friend::join('users', 'users.id', '=', 'friends.friend_two')
            ->where('friend_one', '=', $this->myId())
            ->where('status', '!=', 'confirmed')
            ->select('users.id', 'users.name', 'users.profile_image', 'friends.status')
            ->get();

        $my_requests = Friend::join('users', 'users.id', '=', 'friends.friend_one')
            ->where('friend_two', '=', $this->myId())
            ->where('status', '=', 'pending')
            ->select('users.id', 'users.name', 'users.profile_image', 'friends.status')
            ->get();

        $peoples = array();

        foreach ($set_requests as $requests) {
            $peoples[] = array("id" => $requests->id, "name" => $requests->name, "image" => $requests->profile_image, "status" => $requests->status);
        }

        foreach ($suggested_peoples as $suggested) {
            $peoples[] = array("id" => $suggested->id, "name" => $suggested->name, "image" => $suggested->profile_image, "status" => $suggested->status);
        }

        $all_peoples = $this->unique_multidim_array($peoples, 'id');

        return view('pages.friend.index', compact('all_peoples', 'my_requests'));
    }

    // Send Request
    public function sendRequest($id)
    {
        $checkAvailable = Friend::where('friend_one', '=', $this->myId())
            ->where('friend_two', '=', $id)
            ->first();

        if ($checkAvailable != null) {
            return redirect()->back()->with('exist', 'Request already sent.');
        } else {
            $form_data = array(
                'friend_one' => $this->myId(),
                'friend_two' => $id,
                'status' => 'pending',
            );

            Friend::create($form_data);
            return redirect()->back()->with('success', 'Request sent .');
        }
    }

    // Cancel Request
    public function cancelRequest($id)
    {
        Friend::where('friend_one', '=', $this->myId())
            ->where('friend_two', '=', $id)
            ->delete();
        return redirect()->back();

    }

}

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
        $peoples = array();
        $requested_me_persons_id = array();
        $after_accept_persons_id = array();

        $requested_me_persons = Friend::where('friend_two', '=', $this->myId())
            ->where('status', '=', 'pending')
            ->get();
        foreach ($requested_me_persons as $value) {
            $requested_me_persons_id[] = array($value->friend_one);
        }

        $after_accept_persons = Friend::where('friend_two', '=', $this->myId())
            ->orWhere('friend_two', '=', $this->myId())
            ->where('status', '=', 'confirmed')
            ->get();
        foreach ($after_accept_persons as $value) {
            $after_accept_persons_id[] = array($value->friend_one or $value->friend_two);
        }

        $suggested_peoples = User::where('id', '!=', $this->myId())
            ->whereNotIn('id', $requested_me_persons_id)
            ->whereNotIn('id', $after_accept_persons_id)
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

        foreach ($set_requests as $requests) {
            $peoples[] = array("id" => $requests->id, "name" => $requests->name, "image" => $requests->profile_image, "status" => $requests->status);
        }

        foreach ($suggested_peoples as $suggested) {
            $peoples[] = array("id" => $suggested->id, "name" => $suggested->name, "image" => $suggested->profile_image, "status" => $suggested->status);
        }

        $all_peoples = $this->unique_multidim_array($peoples, 'id');

        //
        //
        //
        // My all friends
        $my_friends = array();

        // Friends which in my list
        $friends_in_my_list = Friend::join('users', 'users.id', '=', 'friends.friend_two')
            ->where('friend_one', '=', $this->myId())
            ->where('status', '=', 'confirmed')
            ->get();
        foreach ($friends_in_my_list as $friend) {
            $my_friends[] = array("id" => $friend->id, "name" => $friend->name, "image" => $friend->profile_image);
        }

        // Freinds me their list
        $friends_me_there_list = Friend::join('users', 'users.id', '=', 'friends.friend_one')
            ->where('friend_two', '=', $this->myId())
            ->where('status', '=', 'confirmed')
            ->get();

        foreach ($friends_me_there_list as $friend) {
            $my_friends[] = array("id" => $friend->id, "name" => $friend->name, "image" => $friend->profile_image);
        }
        $all_my_friends = $this->unique_multidim_array($my_friends, 'id');
        //
        //

        return view('pages.friend.index', compact('all_peoples', 'my_requests', 'all_my_friends'));
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

    // Accept Request
    public function acceptRequest($id)
    {
        $form_data = array(
            'status' => 'confirmed',
        );

        $record = Friend::where('friend_one', '=', $id)
            ->where('friend_two', '=', $this->myId());
        $record->update($form_data);
        return redirect()->back()->with('success', 'Successfully request accepted');
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

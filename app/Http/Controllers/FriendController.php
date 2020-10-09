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

        $requests_friends_ids = array();
        $all_suggesetd_peoples = array();
        $sent_requests_by_me = array();
        $requested_to_me = array();
        $my_friends = array();

        // Friend requests
        // Friend requests send by me
        $requested_by_me = Friend::join('users', 'users.id', '=', 'friends.friend_two')
            ->where('friend_one', '=', $this->myId())
            ->where('status', '!=', 'confirmed')
            ->select('users.id', 'users.name', 'users.profile_image', 'friends.status')
            ->get();

        foreach ($requested_by_me as $requests) {
            $sent_requests_by_me[] = array("id" => $requests->id, "name" => $requests->name, "image" => $requests->profile_image, "status" => $requests->status);
            $requests_friends_ids[] = array($requests->friend_two);
        }

        // Request me for add
        $requests_for_add = Friend::join('users', 'users.id', '=', 'friends.friend_one')
            ->where('friend_two', '=', $this->myId())
            ->where('status', '=', 'pending')
            ->select('users.id', 'users.name', 'users.profile_image', 'friends.status')
            ->get();

        foreach ($requests_for_add as $request) {
            $requested_to_me[] = array("id" => $request->id, "name" => $request->name, "image" => $request->profile_image, "status" => $request->status);
            $requests_friends_ids[] = array($request->friend_one);
        }

        // Friends which in my list
        $friends_in_my_list = Friend::join('users', 'users.id', '=', 'friends.friend_two')
            ->where('friend_one', '=', $this->myId())
            ->where('status', '=', 'confirmed')
            ->get();
        foreach ($friends_in_my_list as $friend) {
            $my_friends[] = array("id" => $friend->id, "name" => $friend->name, "image" => $friend->profile_image);
            $requests_friends_ids[] = array($friend->friend_two);
        }

        // Freinds me their list
        $friends_me_there_list = Friend::join('users', 'users.id', '=', 'friends.friend_one')
            ->where('friend_two', '=', $this->myId())
            ->where('status', '=', 'confirmed')
            ->get();

        foreach ($friends_me_there_list as $friend) {
            $my_friends[] = array("id" => $friend->id, "name" => $friend->name, "image" => $friend->profile_image);
            $requests_friends_ids[] = array($friend->friend_one);
        }
        // All friends unique
        $all_my_friends = $this->unique_multidim_array($my_friends, 'id');

        //
        //
        // Suggested peoples
        $suggested_peoples = User::where('id', '!=', $this->myId())
            ->whereNotIn('id', $requests_friends_ids)
            ->select('id', 'name', 'profile_image')
            ->get();
        foreach ($suggested_peoples as $suggested) {
            $all_suggesetd_peoples[] = array("id" => $suggested->id, "name" => $suggested->name, "image" => $suggested->profile_image);
        }

        return view('pages.friend.index', compact('all_suggesetd_peoples', 'requested_to_me', 'sent_requests_by_me', 'all_my_friends'));
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

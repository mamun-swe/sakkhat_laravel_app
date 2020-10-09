<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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

    // Your Friend List
    public function index()
    {
        $my_friends = array();

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

        return view('pages.chat.index', compact('all_my_friends'));
    }

    // Go chatting
    public function goChat($id)
    {
        if ($id) {

            $messages = array();
            $sent_messages = Message::where('sender_id', '=', auth()->id())
                ->where('reciver_id', '=', $id)
                ->get();
            foreach ($sent_messages as $message) {
                $messages[] = array(
                    "sender_id" => $message->sender_id,
                    "reciver_id" => $message->reciver_id,
                    "message" => $message->message_content,
                    "time" => $message->created_at,
                );
            }

            $get_messages = Message::where('reciver_id', '=', auth()->id())
                ->where('sender_id', '=', $id)
                ->get();
            foreach ($get_messages as $message) {
                $messages[] = array(
                    "sender_id" => $message->sender_id,
                    "reciver_id" => $message->reciver_id,
                    "message" => $message->message_content,
                    "time" => $message->created_at,
                );
            }

            $sortedMessages = collect($messages)->sortBy('time')->all();

            return view('pages.chat.chatRoom', compact('id', 'sortedMessages'));
        } else {
            return abort(404);
        }
    }

    // Sent Message
    public function sentMessage(Request $request)
    {
        $rules = [
            'message_content' => 'required',
        ];
        $this->validate($request, $rules);
        $form_data = array(
            'sender_id' => auth()->id(),
            'reciver_id' => number_format($request->reciver_id),
            'message_content' => $request->message_content,
        );

        Message::create($form_data);
        return redirect()->back()->with('success', 'Successfully message sent .');
    }

}

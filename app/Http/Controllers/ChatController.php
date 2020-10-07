<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Your Friend List
    public function index()
    {
        $uid = Auth::user()->id;
        // $friendOne = Friedns::rightJoin('users', 'users.id', '=', 'friedns.friend_two')
        //         -> where('friedns.friend_one', '=', $uid)
        //         ->where('friedns.status', '=', 1)->get();

        // $friendTwo = Friedns::rightJoin('users', 'users.id', '=', 'friedns.friend_one')
        // -> where('friedns.friend_two', '=', $uid)
        // ->where('friedns.status', '=', 1)->get();
        // return view('pages.chat.chat-index', compact('friendOne', 'friendTwo'));

        // $sql = 'SELECT * FROM `relationship` WHERE ' .
        //     '(`user_one_id` = ' . $userId . ' OR `user_two_id` = ' . $userId . ') ' .
        //     'AND `status` = 1';

        $query = Friend::where('friend_one', '=', $uid)
                ->orWhere('friend_one', '=', $uid)
                ->where('status', '=', 1)
                ->get();

        dd($query);

        $resultObj = $this->dbCon->query($sql);

        $friends = array();

        while ($row = $resultObj->fetch_assoc()) {
            if ($row['user_one_id'] !== $userId) {
                $friends[] = $row['user_one_id'];
            }

            if ($row['user_two_id'] !== $userId) {
                $friends[] = $row['user_two_id'];
            }
        }

        return $friends;
    }

    // Go chatting
    public function goChat($id)
    {
        if ($id) {
            $reciverId = $id;
            return view('pages.chat.send-show-message', compact('reciverId'));
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
            'reciver_id' => $request->reciver_id,
            'message_content' => $request->message_content,
        );
        Message::create($form_data);
        return redirect()->back()->with('success', 'Successfully message sent .');
    }

    // Show Message
    public function showMessage($id)
    {
        $reciver = $id;
        $sender = auth()->id();
        $senderMessages = Message::where('sender_id', '=', $sender)
            ->where('reciver_id', '=', $reciver)->get();

        $reciverMessage = Message::where('reciver_id', '=', $sender)
            ->where('sender_id', '=', $reciver)->get();
        return response()->json([$senderMessages, $reciverMessage]);
    }
}

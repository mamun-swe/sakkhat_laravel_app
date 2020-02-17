<?php

namespace App\Http\Controllers;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // create comment
    public function createComment(Request $request){
        $rules = [
            'post_id'=>'required',
            'comment'=>'required',
        ];
        $this->validate($request,$rules);
        $form_data = array(
            'uid'=> auth()->id(),
            'post_id'=> $request->post_id,
            'comment'=> $request->comment,
        );
        Comment::create($form_data);
        return redirect()->back()->with('success', 'Successfully commented .');
    }

    // get comments
    public function getComments($id){
        $postComments = User::rightJoin('comments', 'comments.uid', '=', 'users.id')
                        ->where('comments.post_id', $id)
                        ->orderBy('comments.id', 'DESC')->get();
        return response()->json([$postComments]);
    }
}
<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id=null){
        if($id){
            $user = User::where('id', $id)->first();
            $posts = Post::where('uid', $id)->orderBy('id', 'DESC')->paginate(10);
            if($user){
                return view('pages.profile.index', compact('posts', 'user'));
            } else {
                return abort(404);
            }
       }
       else{
        return abort(404);
       }
    }


    public function edit($id)
    {
        return view('pages.profile.edit');
    }


    public function updateProfilePic(Request $request, $id) {
        $rules = [
            'profile_image'=>'required',
        ];
        $this->validate($request,$rules);

            if($request->hasfile('profile_image')){
                // Profile Image
                $profileFile = $request->file('profile_image');
                $profileExtension = $profileFile->getClientOriginalExtension();
                $profilefilename = time() . '.' . $profileExtension;
                $profileFile->move('profile', $profilefilename);

                $form_data = array(
                    'id'=> auth()->id(),
                    'profile_image'=> $profilefilename
                );

                $record = User::where('id', $id);
                $record->update($form_data);
                return redirect()->back()->with('success', 'Profile Update successfully');
            }
    }


    public function updateCoverPic(Request $request, $id) {
        $rules = [
            'cover_image'=>'required',
        ];
        $this->validate($request,$rules);

            if($request->hasfile('cover_image')){
                // Profile Image
                $coverFile = $request->file('cover_image');
                $coverExtension = $coverFile->getClientOriginalExtension();
                $coverfilename = time() . '.' . $coverExtension;
                $coverFile->move('cover', $coverfilename);

                $form_data = array(
                    'id'=> auth()->id(),
                    'cover_image'=> $coverfilename
                );

                $record = User::where('id', $id);
                $record->update($form_data);
                return redirect()->back()->with('success', 'Cover Update successfully');
            }
    }
}
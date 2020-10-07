<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = date('Y-m-d');
        $posts = Post::where('uid', '=', auth()->id())
            ->where('posted_on', '=', $today)
            ->orderBy('posted_on', 'desc')
            ->take(2)
            ->get();

        if (count($posts) >= 2) {
            return redirect()->back()->with('success', 'You have cross to post limit for today .');
        }

        $rules = [
            'content' => 'required',
            'image' => 'required',
        ];
        $this->validate($request, $rules);
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('posts', $filename);

        $form_data = array(
            'uid' => auth()->id(),
            'content' => $request->content,
            'image' => $filename,
            'posted_on' => $today,
        );

        Post::create($form_data);
        return redirect()->back()->with('success', 'Successfully posted .');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::find($id);
        if ($data) {
            $user = User::find($data->uid);
            return view('pages.posts.show', compact("data", "user"));
        } else {
            return view('pages.posts.show')->withMessage("No result found");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::find($id);
        return view('pages.posts.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'content' => 'required',
        ];
        $this->validate($request, $rules);
        $record = Post::find($id);
        $record->update($request->all());
        return redirect()->back()->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}

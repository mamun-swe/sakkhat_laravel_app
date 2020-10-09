<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::find(auth()->id());
        return view('pages.about.index', compact('about'));
    }

    public function create()
    {
        return view('pages.about.create');
    }

    public function store(Request $request)
    {
        $form_data = array(
            'uid' => auth()->id(),
            'phone' => $request->phone,
            'school' => $request->school,
            'school_year' => $request->school_year,
            'college' => $request->college,
            'college_year' => $request->college_year,
            'university' => $request->university,
            'university_year' => $request->university_year,
            'address' => $request->address,
        );

        About::create($form_data);
        return redirect()->back()->with('success', 'Successfully Added .');
    }

    public function edit($id)
    {
        $about = About::find($id);
        return view('pages.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $record = About::find($id);
        $record->update($request->all());
        return redirect()->back()->with('success', 'Successfully updated.');
    }

    // public function show($id)
    // {
    //     $about = About::find($id);
    //     if (!$about) {
    //         return abort(404);
    //     }
    //     return view('pages.about.show', compact('about'));
    // }
}

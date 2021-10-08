<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index', ['tags' => $tags]);
    }

    public function form()
    {
        $data = [];

        if (!empty($id = request()->route()->parameter('id'))) {
            $data['tag'] = Tag::find($id);
        }

        return view('tags.form', $data);
    }

    public function create()
    {
        Tag::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
        ]);

        return redirect('/tags');
    }

    public function update()
    {
        $request = request();

        $tags = Tag::find($request->route()->parameter('id'));
        $tags->update([
            'title' => $request->get('title'),
            'slug' => $request->get('slug')
        ]);

        return redirect('/tags');
    }

    public function delete()
    {
        $tags = Tag::find(request()->route()->parameter('id'));
        $tags->posts()->detach();
        $tags->delete();

        return redirect('/tags');
    }
}

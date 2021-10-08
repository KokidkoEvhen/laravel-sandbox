<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', ['posts' => $posts]);
    }

    public function form()
    {
        $data = [];
        $data['tags'] = Tag::all();
        $data['categories'] = Category::all();

        if (!empty($id = request()->route()->parameter('id'))) {
            $data['post'] = Post::with('tags')->find($id);
        }

        return view('posts.form', $data);
    }

    public function create()
    {
        $request = request();

        $post = Post::create([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'body' => $request->get('body'),
            'category_id' => $request->get('category_id')
        ]);
        $post->tags()->sync($request->get('tags_id'));

        return redirect('/posts');
    }

    public function update()
    {
        $request = request();

        $post = Post::find($request->route()->parameter('id'));
        $post->update([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'body' => $request->get('body'),
            'category_id' => $request->get('category_id'),
        ]);
        $post->tags()->sync($request->get('tags_id'));

        return redirect('/posts');
    }

    public function delete()
    {
        $post = Post::find(request()->route()->parameter('id'));
        $post->tags()->detach();
        $post->delete();

        return redirect('/posts');
    }
}

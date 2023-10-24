<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function createJob()
    {
        return view('posts.job');
    }
    public function createNews()
    {
        return view('posts.news');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'type' => 'required',
        ]);
        $data['image'] = $request->image->store('public');
        $data['user_id'] = auth()->id();

        Post::create($data);
        alert()->success('Success', 'Record has been posted!');
        return back();
    }
}

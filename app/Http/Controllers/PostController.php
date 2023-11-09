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
    public function deleteConfirm(Post $post)
    {
        return view('posts.deleteConfirm', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        alert()->success('Success', 'Record has been deleted!');

        return redirect()->to('/posts'); 
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'type' => 'required',
        ]);
        $data['image'] = $request->image->store('public');
        $data['user_id'] = auth()->id();

        $post->update($data); 
        alert()->success('Success', 'Record has been updated!');
        return back();
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
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

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return inertia()->render('Posts', [
            'posts' => Post::with('user')->latest()->paginate(5),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'body' => ['required'],
        ]);

        $data['user_id'] = auth()->id();
        Post::create($data);

        return redirect()->to('/posts');
    }
}

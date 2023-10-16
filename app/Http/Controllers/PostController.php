<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostCreatedNotification;
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

        $post = Post::create($data);

        $users = User::get();

        foreach ($users as $user) {
            if ($user->id == auth()->id()) {
                continue;
            }

            $user->notify(new NewPostCreatedNotification());
        }

        return redirect()->to('/posts');
    }
}

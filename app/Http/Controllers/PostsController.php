<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Jobs\UpdatePostJob;
use App\Jobs\CreatePostJob;
use App\Jobs\DeletePostJob;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255|min:1',
        ]);

        CreatePostJob::dispatch($request->input('content'), null);

        return [
            'message' => 'Dispatched',
        ];
    }

    public function show(Request $request)
    {
        return Post::orderBy('id', 'DESC')->paginate(10);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'content' => 'required|max:255|min:1',
        ]);

        UpdatePostJob::dispatch($request->input('content'), $id);

        return [
            'message' => 'Dispatched',
        ];
    }

    public function destroy(Request $request, int $id)
    {
        DeletePostJob::dispatch($id);

        return [
            'message' => 'Dispatched',
        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Jobs\CreateOrUpdatePostJob;
use App\Jobs\DeletePostJob;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        CreateOrUpdatePostJob::dispatch($request->input('content'), null);

        return true;
    }

    public function show(Request $request)
    {
        return Post::orderBy('id', 'DESC')->paginate(10);
    }

    public function update(Request $request, int $id)
    {
        CreateOrUpdatePostJob::dispatch($request->input('content'), $id);

        return true;
    }

    public function destroy(Request $request, int $id)
    {
        DeletePostJob::dispatch($id);

        return true;
    }
}

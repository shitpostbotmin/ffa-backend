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
        $page = $request->input('page', 1);
        $index = $page - 1;

        $efsMnt = env('EFS_MOUNT_LOCATION');
        $filename = "$efsMnt/cache_page_$index.json";
        
        if (!file_exists($filename)) {
            return response([
                'message' => 'Page cachefile not found.',
            ], 404);
        }

        $json = file_get_contents($filename);
        $data = json_decode($json, true);

        return [
            'data' => $data,
        ];
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

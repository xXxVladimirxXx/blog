<?php

namespace App\Services;

use App\Models\{Post, File};
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function get()
    {
        return Post::
            with(['files', 'comments'])
            ->paginate(request('perPage') ?? 10);
    }

    public function store($title, $content, $file)
    {
        $post = Post::create(['title' => $title, 'content' => $content, 'user_id' => Auth::user()->id]);
        
        if ($file) {
            $fileService = new FileService(new File(), new StorageService());
            $fileService->save($post, $file);
       }
        
        return $post;
    }

    public function update()
    {
        //
    }
}
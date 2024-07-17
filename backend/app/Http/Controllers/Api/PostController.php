<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
use Illuminate\Http\JsonResponse;
use Exception;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        try {
            return $this->successResponse($this->postService->get());
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show(Post $post): JsonResponse
    {
        return $this->successResponse($post);
    }

    public function store(PostRequest $request): JsonResponse
    {
        try {
            return $this->successResponse($this->postService->store(
                $request->get('title'),
                $request->get('content'),
                $request->file('file')
            ));
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(PostRequest $request, Post $post): JsonResponse
    {
        try {
            return $this->successResponse($this->postService->update($request, $post));
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function delete(Post $post): JsonResponse
    {
        try {
            $post->comments()->delete();
            $post->delete();
            
            return $this->successResponse([]);
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostApiController extends Controller
{
    protected $repository;

    public function __construct(Post $post)
    {
        $this->repository = $post;
    }

    public function index()
    {
        $posts = $this->repository->paginate();

        return PostResource::collection($posts);
    }
}

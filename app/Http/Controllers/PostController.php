<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Follow;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $followingPageIds = auth()->user()->follows()->whereFollowableType(Page::class)->pluck('followable_id');
        $followingUserIds = auth()->user()->follows()->whereFollowableType(User::class)->pluck('followable_id');
        $followingUserIds[] = auth()->id();

        $posts = Post::with('user')->where(function ($query) use ($followingUserIds) {
            $query->where('postable_type', User::class)
                ->whereIn('postable_id', $followingUserIds);
        })->orWhere(function ($query) use ($followingPageIds) {
            $query->where('postable_type', Page::class)
                ->whereIn('postable_id', $followingPageIds);
        })->latest()->paginate();
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
    }

    public function postByUser(StorePostRequest $request): PostResource
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = auth()->user()->posts()->create($data)->load('postable');
        return new PostResource($post);
    }

    public function postByPage(StorePostRequest $request, Page $page): PostResource
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = $page->posts()->create($data)->load('postable');
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

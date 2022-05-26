<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\UpdateFollowRequest;
use App\Models\Follow;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FollowController extends Controller
{
    public function follow($type, $id)
    {
        if (!in_array($type, ['person', 'page'])) {
            return \response('This url cannot be found', 404);
        }
        if ($type == 'person') {
            User::findOrFail($id);
        } else {
            Page::findOrFail($id);
        }
        if ($type == 'person') {
            Follow::firstOrCreate([
                'user_id' => auth()->id(),
                'followable_type' => User::class,
                'followable_id' => $id
            ]);
        }
        if ($type == 'page') {
            Follow::firstOrCreate([
                'user_id' => auth()->id(),
                'followable_type' => Page::class,
                'followable_id' => $id
            ]);
        }
        return \response('You are now following this ' . $type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFollowRequest $request
     * @return Response
     */
    public function store(StoreFollowRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFollowRequest $request
     * @param Follow $follow
     * @return Response
     */
    public function update(UpdateFollowRequest $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Follow $follow
     * @return Response
     */
    public function destroy(Follow $follow)
    {
        //
    }
}

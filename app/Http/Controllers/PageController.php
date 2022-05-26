<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Response;

class PageController extends Controller
{
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
     * @param StorePageRequest $request
     * @return PageResource
     */
    public function store(StorePageRequest $request): PageResource
    {
        $data = $request->validated();
        $data['user_id']  = auth('sanctum')->id();
        $page = Page::create($data);
        return new PageResource($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePageRequest $request
     * @param \App\Models\Page $page
     * @return Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        //
    }
}

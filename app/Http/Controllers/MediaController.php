<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\RedirectResponse;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function store(CreateMediaRequest $request, MediaService $media_service): RedirectResponse
    {
        if(!$request->file->isValid() || !$request->validated()) {
            return redirect()->back();
        }

        $media = $media_service->store($request->file, $request->name, $request->description);

        return redirect()->route('medias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(UpdateMediaRequest $request, Media $media, MediaService $media_service): RedirectResponse
    {
        if(!$request->validated()) {        
            return redirect()->back();
        }
        
        $updated_media = $media_service->update($request->name, $request->description, $media);

        return redirect($updated_media->path());
    }

    public function destroy(Media $media, MediaService $media_service): RedirectResponse
    {
        $media_service->delete($media);

        return redirect()->route('medias.index');
    }
}

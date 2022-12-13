<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function __construct()
    {
        return response()->json([ 'valid' => auth()->check() ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::with('user')->get();
        return response()->json([
            'status' => 'success',
            'gallery' => $gallery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:2',
            'description' => 'required|string|max:1000',
            'user_id' => 'required',
        ]);

        $gallery = Gallery::create([
            'title'=> $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery created successfully',
            'gallery' => $gallery,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery, $id)
    {
        $gallery = Gallery::with('user')->where('id', $id)->first();
        return response()->json([
            'status' => 'success',
            'gallery' => $gallery,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $gallery = Gallery::find($id);
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery updated successfully',
            'gallery' => $gallery,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery deleted successfully',
            'gallery' => $gallery,
        ]);
    }
    public function getComments(Gallery $gallery, $id)
    {
        $gallery = Gallery::with('comments')->where('id', $id)->get();
        return response()->json([
            'status' => 'success',
            'gallery' => $gallery,
        ]);
    }

    public function getUserGalleries($id) {
        info($id);
        $gallery = Gallery::with('user')->where('user_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'gallery' => $gallery,
        ]);
    }
}

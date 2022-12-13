<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = Image::all();
        return response()->json([
            'status' => 'success',
            'image' => $image,
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
     * @param  \App\Http\Requests\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {
        // $request->validate([
        //     'urls' => 'required|array',
        //     'urls.*' => 'max:250|regex:/(\d)+.(?:jpe?g|png|gif)/'
        // ]);

        foreach($request->urls as $data) {
            Image::create([
              'url' =>  $data['url'],
              'gallery_id' => $data['gallery_id'],
            ]);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'image created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image, $id)
    {
        $image = Image::where('gallery_id', $id)->get(); 
        return response()->json([
            'status' => 'success',
            'image' => $image,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageRequest  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image, $id)
    {
        $image = Image::find($id);
        $image->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'image deleted successfully',
            'image' => $image,
        ]);
    }
}

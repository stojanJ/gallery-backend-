<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
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
        $comment = Comment::all();
        return response()->json([
            'status' => 'success',
            'comment' => $comment,
        ]);
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
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $request->validate([
            'comment' => 'required|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => $request->user_id,
            'gallery_id'=> $request->gallery_id,
            'comment' => $request->comment,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'comment created successfully',
            'comment' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment, $id)
    {
        $comment = Comment::where('gallery_id', $id )->with('user')->get();
        return response()->json([
            'status' => 'success',
            'comment' => $comment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, $id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'comment deleted successfully',
            'comment' => $comment,
        ]);
    }
}

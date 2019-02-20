<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->ajax() ){
            $product_id = $request->input('product_id');
            $comments = Comment::where('product_id', $product_id )
                ->where('parent_id',0)
                ->with('author')
                ->with(['children' => function($query) {
                    $query->with('author');
                }])
                ->orderByDesc('id')
                ->paginate(2);
            return response($comments, 200);
        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|string',
            'product_id' => 'required|numeric',
            'parent_id' => 'required|numeric'

        ],[
            'body.required' => 'Vui lòng nhập nội dung'
        ]);

        $comment = auth()->user()
            ->comments()
            ->create($data);

        if( $comment->parent_id == 0 ){
            $comment
                ->load(['children' => function($query) {
                    $query->with('author');
                }])
                ->load('author');
            return response($comment, 200);
        }

        $commentRoot = Comment::where( 'id', $comment->parent_id)->first();
        $commentRoot
            ->load(['children' => function($query) {
                $query->with('author');
            }])
            ->load('author');

        return response($commentRoot, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        
        $data = $request->validate([
            'body' => 'required|string'
        ],[
            'body.required' => 'Vui lòng nhập nội dung'
        ]);

        $comment->body = $data['body'];
        $comment->save();


        if( $comment->parent_id == 0 ){
            $comment
                ->load(['children' => function($query) {
                    $query->with('author');
                }])
                ->load('author');
                return response($comment, 200);
        }

        $commentRoot = Comment::where( 'id', $comment->parent_id)->first();
        $commentRoot
            ->load(['children' => function($query) {
                $query->with('author');
            }])
            ->load('author');

        return response($commentRoot, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {

        $comment->delete();
        if( $comment->parent_id !== 0 ){
            $commentRoot = Comment::where( 'id', $comment->parent_id)->first();
            $commentRoot
                ->load(['children' => function($query) {
                    $query->with('author');
                }])
                ->load('author');
            return response($commentRoot, 200);
        }

        return response( $comment,200);
    }
}

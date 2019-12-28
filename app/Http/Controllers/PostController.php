<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;

class PostController extends Controller{

    public function index(){

        Post::query()->update([
            'updated_at' => date('Y-m-d G:i:s')
        ]);
        return Post::get(['id', 'title','body', 'updated_at']);
    }

    public function show($post){
        $post = explode(",",$post);
        Post::whereIn('id', $post)
        ->update([
            'updated_at' => date('Y-m-d G:i:s')
        ]);

        return Post::whereIn('id', $post)->get();
    }

    public function store(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post){

        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function delete(Post $post){

        $post->delete();
        return response()->json(null, 204);
    }
}
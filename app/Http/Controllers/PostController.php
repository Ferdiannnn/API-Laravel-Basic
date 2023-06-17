<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author:id,username'])->get();
        return response()->json([
            'success' => true,
            'message' => 'List Semua Post',
            'data' => $posts
        ], 200);
    }
    public function show($id)
    {
        $post = Post::with(['author:id,username', 'komen'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Post',
            'data' => $post
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'news_content' => 'required',
        ]);

        $request['author'] = auth()->user()->id;
        $post = Post::create(
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Post Berhasil Disimpan',
            'data' => $post
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'news_content' => 'required',
        ]);
        $post = Post::findOrFail($request->id);
        $post->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Post Berhasil update',
            'data' => $post
        ], 200);

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Berhasil dihapus',
        ], 200);
    }

}
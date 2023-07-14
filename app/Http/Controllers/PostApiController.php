<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
     public function index() {
        $posts = Post::whereStatus(1)->get();
        return response()->json($posts, 200);
    }

    public function show($id) {
        $post = Post::find($id);
        return response()->json($post, 200);
    }
}

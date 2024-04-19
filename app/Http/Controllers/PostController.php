<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {

        $title = '';
        return view('post', [
        "title"  => "Beranda" .$title,
        "active" => 'beranda',
        "posts" => Post::latest()->get()
    ]);
    }

    public function show(Post $post){

        return view('show', [ 
            "title" => "Postingan",
            "active" => 'beranda',
            "post" => $post
            ]);
    }
}
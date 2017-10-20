<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)    // public function show($id)
    {
//        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
//        ***variant 1***
//        $post = new Post;
//
//        create a new post using the request data
//        $post->title = request('title');
//        $post->body = request('body');
//
//        // save it to the database
//        $post->save();
//
//        ***variant 2***
//        Post::create([
//            'title' => request('title'),
//            'body'  => request('body')
//        ]);

//        data validation
        $this->validate(request(), [
            'title' => 'required',
            'body'  => 'required'
        ]);

        Post::create(request(['title', 'body']));

        // redirect to the home page
        return redirect('/');
    }

}

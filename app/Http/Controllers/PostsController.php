<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\Posts;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
//        dd($posts);
//        $posts = $posts->all();
//        $posts = (new \App\Repositories\Posts)->all();

        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();

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

        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );
/*
        Post::create([
            'title'     => request('title'),
            'body'      => request('body'),
            'user_id'   => auth()->id()
        ]);
*/

        session()->flash('message', 'Your post has been published');

        // redirect to the home page
        return redirect('/');
    }

}

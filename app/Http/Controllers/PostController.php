<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('VerifyCategoryCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.index' , compact('posts'))->with('categories', Category::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')->with('categories', Category::all())
                                  ->with('tags', Tag::all());
    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // dd($request->all());
        //create post
        $post = Post::create([
              "title" => $request->title,
              "description" => $request->description,
              "content" => $request->content,
              "published_at" => $request->published_at,
              "category_id" => $request->category_id,
              "user_id" => auth()->user()->id,
              "image" => $this->storeImage($request)
        ]);

        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }
        //flashing session
        Session()->flash('status', 'Post created successfully');

        //redirect user
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        // dd($post->tags);
        //requested attribute update
        $data = $request->only(['title', 'description', 'content', 'published_at','category_id']);
        //check if request has new image
        if($request->hasFile('image'))
        {
            //store new image
            $image = $request->image->store('posts','public');
            //delete old image

            //deleteImage()defined in model
            $post->deleteImage();

            $data['image'] = $image;
        }
        //for tag edit
        if($post->tags)
        {
            $post->tags()->sync($request->tags);
        }
        //storing attribute
        $post->update($data);
        //flashing session
        session()->flash('status', 'Post updated successfully');
        //redirect user
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if( $post->trashed() )
        {
            //deleteImage()defined in model
            $post->deleteImage();

            $post->forceDelete(); //delete permantly
        }
        else{
        $post->delete(); //move trash or soft delete
        }

        Session()->flash('status','Post deleted successfully');
        //redirect user
        return redirect()->route('posts.index');
    }

    /**
     * to view trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        Session()->flash('status','Post trashed successfully');
        return view('post.index')->withPosts($trashed); //withPosts($trashed) same as with('posts', $trashed)
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('status', 'Post restored successfully');

        return redirect()->route('posts.index');
    }

    //handle the image storage request
    private function storeImage($request)
    {
        //if request has image
        if($request->hasFile('image'))
        {
            //storing image
            return $image = $request->image->storeAs('posts','public');
        }

    }
}

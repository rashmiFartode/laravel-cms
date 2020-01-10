<?php

namespace App\Http\Controllers\Blog;

use App\Post;
use App\Tag;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')->with(compact('post'));
    }

    public function category(Category $category)
    {
        return view('blog.category')->with('category', $category)
            ->with('posts', $category->posts()->searched()->simplePaginate(3))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {
        // dd('tag im');
        return view('blog.tag')
            ->with('tag', $tag)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $tag->posts()->searched()->simplePaginate(3));
    }
}

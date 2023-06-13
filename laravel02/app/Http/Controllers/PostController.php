<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('posts/add', compact('categories'));
    }

    public function handleCreate(Request $request)
    {

        //Thêm vào bảng post => lấy id sau khi thêm
        $post = new Post();
        $post->title = $request->title;
        $post->save();

        //Dựa vào post đã được tạo để thêm vào bảng trung gian
        $post->categories()->attach($request->categories);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $categoryArr = array_map(function ($item) {
            return $item['id'];
        }, $post->categories->toArray());

        return view('posts/edit', compact('categories', 'post', 'categoryArr'));
    }

    public function handleEdit(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->save();

        $post->categories()->sync($request->categories);

        return back();
    }

    public function delete($id)
    {
        Post::destroy($id);
        return back();
    }
}

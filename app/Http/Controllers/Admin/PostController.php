<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('image');
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/blogs'), $imageName);
            $data['image'] = 'images/blogs/' . $imageName;
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('image');
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/blogs'), $imageName);
            $data['image'] = 'images/blogs/' . $imageName;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Blog post deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public static function getPosts()
    {
        return Post::all()->keyBy('slug')->toArray();
    }

    public function index(Request $request)
    {
        $postsRaw = Post::orderBy('published_at', 'desc')->paginate(6);
        
        $postsRaw->getCollection()->transform(function ($post) {
            $post->link = route('blog.show', $post->slug);
            $post->image = asset($post->image);
            $post->date = $post->published_at ? $post->published_at->format('F d, Y') : '';
            return $post;
        });

        return view('blog.index', ['posts' => $postsRaw]);
    }

    public function show($slug)
    {
        $postModel = Post::where('slug', $slug)->firstOrFail();
        
        $post = $postModel->toArray();
        $post['link'] = route('blog.show', $post['slug']);
        $post['image'] = asset($post['image']);
        $post['date'] = $postModel->published_at ? $postModel->published_at->format('F d, Y') : '';
        
        $relatedPostsRaw = Post::where('slug', '!=', $slug)->inRandomOrder()->take(3)->get();
        $relatedPosts = [];
        foreach($relatedPostsRaw as $rel) {
            $relatedPosts[] = [
                'title' => $rel->title,
                'category' => $rel->category,
                'image' => asset($rel->image),
                'date' => $rel->published_at ? $rel->published_at->format('F d, Y') : '',
                'link' => route('blog.show', $rel->slug)
            ];
        }

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}

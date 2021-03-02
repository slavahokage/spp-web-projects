<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }


    public function newPost()
    {
        return view('posts.new');
    }


    public function create(Request $request)
    {

        $validated = $request->validate([
            'title'    => 'required|string|unique:posts|min:5|max:100',
            'content'  => 'required|string|min:5|max:2000',
            'category' => 'required|string|max:30'
        ]);


        $validated['slug'] = Str::slug($validated['title'], '-');

        if ($request->hasFile('user_file')) {
            $originalFilename = $request->file('user_file')->getClientOriginalName();

            $validated['filename_hash'] = $request->file('user_file')->store('');

            $validated['original_filename'] = $originalFilename;


        }

        $post = Post::create($validated);

        return redirect(route('posts.show', $post))->with('notification', 'Post created!');
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $previousFilename = $post->filename_hash;

        $validated = $request->validate([
            'title'    => 'required|string|unique:posts|min:5|max:100',
            'content'  => 'required|string|min:5|max:2000',
            'category' => 'required|string|max:30'
        ]);

        $validated['slug'] = Str::slug($validated['title'], '-');

        if ($request->hasFile('user_file')) {
            $originalFilename = $request->file('user_file')->getClientOriginalName();

            $validated['filename_hash'] = $request->file('user_file')->store('');

            $validated['original_filename'] = $originalFilename;

            Storage::delete($previousFilename);

        }

        $post->update($validated);

        return redirect(route('posts.show', $post))->with('notification', 'Post updated!');
    }


    public function destroy(Post $post)
    {
        Storage::delete($post->filename_hash);

        $post->delete();

        return redirect(route('posts.index'))->with('notification', '"' . $post->title .  '" deleted!');
    }

    public function download($hash)
    {
        return Storage::download($hash);
    }
}

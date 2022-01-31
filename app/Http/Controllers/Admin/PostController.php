<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(3);

        return view('admin.posts.index', [
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\PostFormRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostFormRequest $request)
    {
        $post = Post::create($request->validated());

        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.create', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\PostFormRequest $request
     * @param int                                      $id
     *
     */
    public function update(PostFormRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->validated();

        if($request->has('thumbnail')) {
            $thumbnail = str_replace('public/posts', '', $request->file('thumbnail')->store('public/posts'));
            $data['thumbnail'] = $thumbnail;
        }

        $post->update($data);

        return redirect(route('admin.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect(route('admin.posts.index'));
    }
}

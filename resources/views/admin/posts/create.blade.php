@extends('layout.admin')
@section('title', isset($post) ? "'Edit Post $post->id" : 'Add Posts')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ isset($post) ? "'Edit Post $post->id" : 'Add Post'}}</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            <form method="POST"
                  enctype="multipart/form-data"
                  action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}"
                  class="space-y-5 mt-5">
                @csrf

                @if(isset($post))
                    @method('PUT')
                @endif

                <input name="title" type="text" class="w-full h-12 border border-gray-800 rounded px-3"
                       value="{{ $post->title ?? '' }}"
                       placeholder="Title" />
                @error('title')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="preview" type="text" class="w-full h-12 border border-gray-800 rounded px-3"
                       value="{{ $post->preview ?? '' }}"
                       placeholder="Preview" />
                @error('preview')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="description" type="text" class="w-full h-12 border border-gray-800 rounded px-3"
                       value="{{ $post->description ?? '' }}"
                       placeholder="Description" />
                @error('description')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                @if(isset($post) && $post->thumbnail)
                    <div>
                        <img class="h-64 w-64"
                             src="/storage/posts/{{ $post->thumbnail }}">
                    </div>
                @endif


                <input name="thumbnail" type="file" class="w-full h-12" placeholder="Thumbnail" />
                @error('thumbnail')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">
                    Save
                </button>
            </form>
        </div>
    </div>

@endsection

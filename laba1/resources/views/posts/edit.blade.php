@section('title', 'Edit Post')
@section('action', route('new'))
@extends('layout')

@section('content')

<h1 class="title">Edit: {{ $post->title }}</h1>

<form enctype="multipart/form-data" method="post" action="{{ route('posts.update', $post) }}">

    @csrf
    @method('patch')
    @include('partials.errors')
    @include('partials.form_content')

</form>

@endsection
